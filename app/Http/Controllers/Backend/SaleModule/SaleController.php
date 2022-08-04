<?php

namespace App\Http\Controllers\Backend\SaleModule;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\LotModule\Lot;
use App\Models\BankModule\Bank;
use App\Models\SaleModule\Sale;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SystemDataModule\Item;
use App\Models\SystemDataModule\Unit;
use App\Models\SaleModule\SaleDetails;
use App\Models\StockModule\StockInOut;
use App\Models\CustomerModule\Customer;
use App\Models\SystemDataModule\Variant;
use App\Models\SystemDataModule\Warehouse;
use App\Models\SystemDataModule\ItemVariant;
use App\Models\TransactionModule\Transaction;

class SaleController extends Controller
{
    //Index
    public function index()
    {
        if(can('all_sale')) {
            return view('backend.modules.sale_module.index');
        } else {
            return view('errors.404');
        }
    }


    // Add New sale
    public function add_new_sale()
    {
        if(can('add_sale')) {

            $customers = Customer::select('id', 'name')->where('is_active', true)->get();
            $items = Item::select('id', 'name')->where('is_active', true)->where('is_delete', false)->get();
            $lots = Lot::select('id', 'name')->get();
            $units = Unit::select('id', 'name')->get();
            $variants = Variant::select('id', 'name')->get();
            $banks = Bank::select('id', 'name')->where('is_active', true)->get();
            // $warehouses = Warehouse::select('id', 'name')->where('is_active', true)->get();
            return view('backend.modules.sale_module.add_sale', compact('customers', 'items', 'lots', 'units', 'variants', 'banks'));
        } else {
            return view('errors.404');
        }
    }

    // Get Item Varients
    public function get_item_varients(Request $request)
    {
        if(can('add_sale')) {
            $id = $request->item_id;
             $item_variants = ItemVariant::with('variant')
                            ->where('item_id', $id)
                            ->get();

            return response()->json($item_variants);
        } else {
            return view('errors.404');
        }
    }

    // Get Lot Items List
    public function get_lot_items(Request $request)
    {
        if(can('add_sale')) {

            $lot_id = $request->lot_id;
            $lot_items = StockInOut::where('lot_id', $lot_id)->get();

            return response()->json($lot_items);

        } else {
            return view('errors.404');
        }
    }

    // Get Item Stock Variant
    public function get_item_stock_variant(Request $request)
    {
        if(can('add_sale')) {
            $item_id = $request->item_id;

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $item_stock = new StockInOut();
            $item_stock_variants = $item_stock->StockItemVariants($item_id);

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB

            return response()->json($item_stock_variants);

        } else {
            return view('errors.404');
        }
    }

    // available_lots
    public function available_lots(Request $request)
    {
        if(can('add_sale')) {
            $ids = explode("_", $request->ids);
            $variant_id = $ids[0];
            $unit_id = $ids[1];
            $item_id = $request->item_id;

            $stock_lots = new StockInOut();
            $lots = $stock_lots->StockLots($item_id, $variant_id, $unit_id);

            return response()->json($lots);
        } else {
            return view('errors.404');
        }
    }

    public function get_warehouse_stock(Request $request)
    {
        if(can('add_sale')) {
            $ids = explode("_", $request->ids);
            $variant_id = $ids[0];
            $unit_id = $ids[1];
            $item_id = $request->item_id;
            $lot_id = $request->lot_id;

            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $stock_warehouses = new StockInOut();
            $warehouse_with_stock = $stock_warehouses->GetWarehouseWithStock($item_id, $variant_id, $unit_id, $lot_id);

            config()->set('database.connections.mysql.strict', true); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            return response()->json($warehouse_with_stock);
        } else {
            return view('errors.404');
        }
    }

    // GET CUSTOMER TOTAL PREVIUOS BALANCE
    public function customer_previous_balance(Request $request)
    {
        if(can('add_sale')) {
            $customer_id = $request->customer_id;
            $customer = new Customer();
            $customer_previous_balance = $customer->CustomerPreviuosBalance($customer_id);

            return response()->json($customer_previous_balance);
        } else {
            return view('errors.404');
        }
    }

    public function store_new_sale(Request $request)
    {
        $data = json_decode($request->data, true);

        $date = Carbon::parse($data['date'])->format('d-m-Y');
        $date_arr = explode('-',$date);

        if ($data['added_items'] && count($data['added_items']) > 0) {
            // Store Data on sale Table
            $sale = new Sale();
            $sale->customer_id = $data['customer_id'];
            $sale->date =  $data['date'];
            $sale->challan_no = $date.'_'.rand(10000, 99999).'_'.$data['customer_id'];
            $sale->total_amount =  $data['sale_total_price'];
            $sale->created_by =  Auth::user()->id;
            if(can('auto_stock')) {
                $sale->status = 'STOCK_IN';
            }

            if ($sale->save()) {

                foreach ($data['added_items'] as $key => $item) {

                    // Store Data on sale Details Table
                    $sale_details = new SaleDetails();
                    $sale_details->sale_id = $sale->id ;
                    $sale_details->item_id = $item['item_id'];
                    $sale_details->unit_id = $item['item_unit_id'];
                    $sale_details->variant_id = $item['item_varient_id'];
                    $sale_details->lot_id = $item['lot_id'];
                    $sale_details->unit_price = $item['unit_price'];
                    $sale_details->quantity = $item['beg'];
                    $sale_details->total_price = $item['total_price'];

                    // Store Data on Permission Table
                    if(can('auto_stock') && $sale_details->save()) {
                        $stock_in_out = new StockInOut();
                        $stock_in_out->date = $data['date'];
                        $stock_in_out->sale_id = $sale->id ;
                        $stock_in_out->item_id = $item['item_id'];
                        $stock_in_out->unit_id = $item['item_unit_id'];
                        $stock_in_out->variant_id = $item['item_varient_id'];
                        $stock_in_out->lot_id = $item['lot_id'];
                        $stock_in_out->warehouse_id = $item['warehouse_id'] ? $item['warehouse_id'] : null;
                        $stock_in_out->out_quantity = $item['beg'];
                        $stock_in_out->save();
                    }
                }


                // Store Data on Transaction Table
                $transaction_sale = new Transaction();
                $transaction_sale->date = $data['date'];
                $transaction_sale->transaction_code = $date_arr[0].$date_arr[1].$date_arr[2].'_'.rand(10000, 99999).'_'.$data['customer_id'].'_SO_'.$sale->id;
                $transaction_sale->invoice_no = $sale->challan_no;

                ////////////////
                $transaction_sale->transaction_type_id = 1;
                /////////

                $transaction_sale->narration = 'Sale New Order';
                $transaction_sale->sale_id = $sale->id;
                $transaction_sale->customer_id = $data['customer_id'];

                $transaction_sale->remarks = isset($data['remarks']) ? $data['remarks'] : '';
                $transaction_sale->cash_out = $data['sale_total_price'] ? $data['sale_total_price'] : 0;
                $transaction_sale->created_by = Auth::user()->id;
                $transaction_sale->save();


                if ($data['sale_deposite_amount']) {

                    $transaction_deposit = new Transaction();
                    $transaction_deposit->date = $data['date'];
                    $transaction_deposit->transaction_code = $date_arr[0].$date_arr[1].$date_arr[2].'_'.rand(10000, 99999).'_'.$data['customer_id'].'_SI_'.$sale->id;
                    $transaction_deposit->invoice_no = $sale->challan_no;

                    ////////////////
                    $transaction_deposit->transaction_type_id = 1;
                    /////////

                    $transaction_deposit->narration = 'Sale Deposite Amount';
                    $transaction_deposit->sale_id = $sale->id;
                    $transaction_deposit->customer_id = $data['customer_id'];

                    if ($data['sale_payment_by'] == "BANK") {
                        $transaction_deposit->payment_by = 'BANK';
                        $transaction_deposit->bank_id = $data['bank_id'];
                        $transaction_deposit->cheque_no = $data['cheque_no'];
                    } elseif ($data['sale_payment_by'] == "CASH") {
                        $transaction_deposit->payment_by = 'CASH';
                    }

                    $transaction_deposit->remarks = isset($data['remarks']) ? $data['remarks'] : '';
                    $transaction_deposit->cash_in = $data['sale_deposite_amount'];
                    $transaction_deposit->created_by = Auth::user()->id;
                    $transaction_deposit->save();
                }
            }
        }

        return back();
    }


}
