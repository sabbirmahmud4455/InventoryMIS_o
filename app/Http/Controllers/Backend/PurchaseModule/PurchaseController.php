<?php

namespace App\Http\Controllers\Backend\PurchaseModule;

use App\Http\Controllers\Controller;
use App\Models\BankModule\Bank;
use App\Models\LotModule\Lot;
use App\Models\PurchaseModule\Purchase;
use App\Models\PurchaseModule\PurchaseDetails;
use App\Models\StockModule\StockInOut;
use App\Models\SupplierModule\Supplier;
use App\Models\SystemDataModule\Item;
use App\Models\SystemDataModule\ItemVariant;
use App\Models\SystemDataModule\Unit;
use App\Models\SystemDataModule\Variant;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //Index
    public function index()
    {
        if(can('all_purchase')) {
            $purchases = Purchase::with('purchase_details', 'supplier')
                        ->orderBy('id', 'desc')
                        ->get();

            return view('backend.modules.purchase_module.index', compact('purchases'));
        } else {
            return view('errors.404');
        }
    }


    // Add New Purchase
    public function add_new_purchase()
    {
        if(can('add_purchase')) {

            $suppliers = Supplier::select('id', 'name')->where('is_active', true)->get();
            $items = Item::select('id', 'name')->where('is_active', true)->where('is_delete', false)->get();
            $lots = Lot::select('id', 'name')->get();
            $units = Unit::select('id', 'name')->get();
            $variants = Variant::select('id', 'name')->get();
            $banks = Bank::select('id', 'name')->where('is_active', true)->get();
            return view('backend.modules.purchase_module.add_purchase', compact('suppliers', 'items', 'lots', 'units', 'variants','banks'));
        } else {
            return view('errors.404');
        }
    }

    // Get Item Varients
    public function get_item_varients(Request $request)
    {
        if(can('add_purchase')) {
            $id = $request->item_id;
             $item_variants = ItemVariant::with('variant')
                            ->where('item_id', $id)
                            ->get();

            return response()->json($item_variants);
        } else {
            return view('errors.404');
        }
    }

    public function store_new_purchase(Request $request)
    {
        $data = json_decode($request->data, true);

        $today = Carbon::now()->format('Y-m-d');
        $date_arr = explode('-',$today);

        if ($data['added_items'] && count($data['added_items']) > 0) {

            // Store Data on Purchase Table
            $purchase = new Purchase();
            $purchase->supplier_id = $data['supplier_id'];
            $purchase->date =  $data['date'];
            $purchase->challan_no = $today.'_'.rand(10000, 99999).'_'.$data['supplier_id'];
            $purchase->total_amount =  $data['purchase_total_price'];
            $purchase->created_by =  Auth::user()->id;
            if(can('auto_stock')) {
                $purchase->status = 'STOCK_IN';
            }

            if ($purchase->save()) {

                foreach ($data['added_items'] as $key => $item) {

                    // Store Data on Purchase Details Table
                    $purchase_details = new PurchaseDetails();
                    $purchase_details->purchase_id = $purchase->id ;
                    $purchase_details->item_id = $item['item_id'];
                    $purchase_details->unit_id = $item['item_unit_id'];
                    $purchase_details->variant_id = $item['item_varient_id'];
                    $purchase_details->lot_id = $item['lot'] ? $item['lot'] : null;
                    $purchase_details->unit_price = $item['unit_price'];
                    $purchase_details->quantity = $item['beg'];
                    $purchase_details->total_price = $item['total_price'];
                    $purchase_details->save();

                    // Store Data on Permission Table
                    if(can('auto_stock')) {
                        $stock_in = new StockInOut();
                        $stock_in->purchase_id = $purchase->id ;
                        $stock_in->item_id = $item['item_id'];
                        $stock_in->unit_id = $item['item_unit_id'];
                        $stock_in->variant_id = $item['item_varient_id'];
                        $stock_in->lot_id = $item['lot'] ? $item['lot'] : '';
                        $stock_in->in_quantity = $item['beg'];
                        $stock_in->save();
                    }
                }


                // Store Data on Transaction Table
                $transaction_purch = new Transaction();
                $transaction_purch->date = $today;
                $transaction_purch->transaction_code = $date_arr[0].$date_arr[1].$date_arr[2].'_'.rand(10000, 99999).'_'.$data['supplier_id'].'_'.$purchase->id;
                $transaction_purch->invoice_no = $purchase->challan_no;

                ////////////////
                $transaction_purch->transaction_type_id = 1;
                /////////
                $transaction_purch->narration = 'Purchase New Order';
                $transaction_purch->purchase_id = $purchase->id;
                $transaction_purch->supplier_id = $data['supplier_id'];

                $transaction_purch->remarks = isset($data['remarks']) ? $data['remarks'] : '';
                $transaction_purch->cash_in = $data['purchase_total_price'] ? $data['purchase_total_price'] : 0;
                $transaction_purch->created_by = Auth::user()->id;
                $transaction_purch->save();


                if ($data['purchase_deposite_amount']) {

                    $transaction_deposit = new Transaction();
                    $transaction_deposit->date = $today;
                    $transaction_deposit->transaction_code = $date_arr[0].$date_arr[1].$date_arr[2].'_'.rand(10000, 99999).'_'.$data['supplier_id'].'_'.$purchase->id;
                    $transaction_deposit->invoice_no = $purchase->challan_no;

                    ////////////////
                    $transaction_deposit->transaction_type_id = 1;
                    /////////
                    $transaction_deposit->narration = 'Deposite Amount';
                    $transaction_deposit->purchase_id = $purchase->id;
                    $transaction_deposit->supplier_id = $data['supplier_id'];

                    if ($data['purchase_payment_by'] == "BANK") {
                        $transaction_deposit->bank_id = $data['bank_id'];
                        $transaction_deposit->cheque_no = $data['cheque_no'];
                    }

                    $transaction_deposit->remarks = isset($data['remarks']) ? $data['remarks'] : '';
                    $transaction_deposit->cash_out = $data['purchase_deposite_amount'];
                    $transaction_deposit->created_by = Auth::user()->id;
                    $transaction_deposit->save();
                }

            }
        }

        return back();
    }


    // View Specific Purchase Data
    public function view_purchase($id)
    {
        if(can('view_purchase')) {

            $purchase = Purchase::with('purchase_details', 'supplier')->find(decrypt($id));
            $purchase_details = PurchaseDetails::with('lot', 'item', 'unit', 'variant')->where('purchase_id', decrypt($id))->get();
            return view('backend.modules.purchase_module.view_purchase', compact('purchase', 'purchase_details'));

        } else {
            return view('errors.404');
        }
    }
}
