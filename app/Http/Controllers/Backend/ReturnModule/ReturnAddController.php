<?php

namespace App\Http\Controllers\Backend\ReturnModule;

use App\Http\Controllers\Controller;
use App\Models\BankModule\Bank;
use App\Models\PurchaseModule\Purchase;
use App\Models\ReturnModule\ItemReturn;
use App\Models\ReturnModule\ItemReturnDetails;
use App\Models\SaleModule\Sale;
use App\Models\StockModule\StockInOut;
use App\Models\SystemDataModule\Warehouse;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Commands\EnableCommand;

class ReturnAddController extends Controller
{
    //Add New Return
    public function add()
    {
        if(can('add_return')) {
            $sale = new Sale();
            $sale_challan_no = $sale->GetSaleChallanNo();

            $purchase = new Purchase();
            $purchase_challan_no = $purchase->GetPurchaseChallanNo();

            return view('backend.modules.return_module.add_return', compact('sale_challan_no', 'purchase_challan_no'));
        } else {
            return view('errors.404');
        }
    }

    // Customer Return View
    public function sales_return_view(Request $request)
    {
        if(can('sales_return')) {

            $sale_id = $request->customer_sale_id;
            $is_exists = $this->return_is_exists($sale_id);

            if($is_exists == true){
                return redirect()->route('return.add')->withErrors(['msg' => __('Return.ItemReturnExists')]);
            }

            DisableDBStrictMode();

            $sale = new Sale();
            $sale_info = $sale->SaleDetails($sale_id);

            $bank = new Bank();
            $banks = $bank->AllBanksWithBalance();

            $transaction = new Transaction();
            $total_amount = $transaction->TotalCashInHandAndBankBalance();

            EnableDBStrictMode();

            $warehouses = Warehouse::select('id', 'name')->where('is_active', true)->where('is_delete', false)->get();

            return view('backend.modules.return_module.sale_return.sale_return_view', compact('sale_info', 'banks', 'total_amount', 'warehouses'));
        } else {
            return view('errors.404');
        }
    }

    // Purchase Return
    public function purchase_return_view(Request $request){
        if(can('purchase_return')) {

            $purchase_id = $request->purchase_id;

            // Check If this return id is exists on return table or not.
            $is_exists = $this->return_is_exists($purchase_id);
            if($is_exists == true){
                return redirect()->route('return.add')->withErrors(['msg' => __('Return.ItemReturnExists')]);
            }

            // Getting Required Data from DB
            DisableDBStrictMode();
            $purchase = new Purchase();
            $purchase_info = $purchase->PurchaseDetails($purchase_id);

            $bank = new Bank();
            $banks = $bank->AllBanksWithBalance();

            $transaction = new Transaction();
            $total_amount = $transaction->TotalCashInHandAndBankBalance();

            EnableDBStrictMode();

            $warehouses = Warehouse::select('id', 'name')->where('is_active', true)->where('is_delete', false)->get();


            return view('backend.modules.return_module.purchase_return.purchase_return_view',
                        compact('purchase_info','warehouses', 'banks', 'total_amount' ));

        } else {
            return view('errors.404');
        }
    }

    // Return Is Exists or Not
    protected function return_is_exists($sale_id){
        $item_return = ItemReturn::select('sale_id')
                    ->where('sale_id', $sale_id)
                    ->first();

        if($item_return){
            return true;
        }
    }

    // Customer Return Store
    public function sales_return_store(Request $request)
    {
        if(can('sales_return')) {
            $this->ItemReturnStore($request);
        } else {
            return view('errors.404');
        }
    }

    protected function ItemReturnStore($request){

        $date = Carbon::now();
        $today = $date->toDateString();

        $item_return = new ItemReturn();
        $item_return->date = $today;
        $item_return->sale_id = $request->sale_id;
        $item_return->invoice_no = $request->invoice_no;
        $item_return->return_amount = $request->return_amount;
        if($request->adjust == 1){
            $item_return->status = 'AdjustWithStock';
            $this->AdjustWithStock($request);
        } else {
            $item_return->status = 'Wastage';
        }

        if($request->return_amount && $request->return_amount > 0){
            $this->ReturnTransactionCashIn($request);
        }

        if($request->deposit_amount && $request->deposit_amount > 0) {
            $this->ReturnTransactionCashOut($request);
        }

        if($item_return->save()){
            $this->ItemReturnDetailsStore($request, $item_return->id);
        }
    }

    protected function ItemReturnDetailsStore($request, $item_id){
        foreach($request->item_id as $key => $item) {
            $item_return_details                    = new ItemReturnDetails();
            $item_return_details->item_return_id    = $item_id;
            $item_return_details->item_id           = $item;
            $item_return_details->lot_id            = $request->lot_id[$key];
            $item_return_details->variant_id        = $request->variant_id[$key];
            $item_return_details->unit_id           = $request->unit_id[$key];
            $item_return_details->return_qnty       = $request->return_quantity[$key];
            $item_return_details->unit_price        = $request->unit_price[$key];
            $item_return_details->total_price       = $request->return_amount[$key];
            $item_return_details->warehouse_id      = $request->warehouse_id[$key];
            $item_return_details->save();
        }
    }

    protected function AdjustWithStock($request){
        $date = Carbon::now();
        $today = $date->toDateString();

        foreach($request->item_id as $key => $item){
            $stock_in               = new StockInOut();
            $stock_in->date         = $today;
            $stock_in->sale_id      = $request->sale_id;
            $stock_in->item_id      = $item;
            $stock_in->variant_id   = $request->variant_id[$key];
            $stock_in->unit_id      = $request->unit_id[$key];
            $stock_in->in_quantity  = $request->return_quantity[$key];
            $stock_in->warehouse_id = $request->warehouse_id[$key];
            $stock_in->lot_id       = $request->lot_id[$key];

            $stock_in->save();
        }
    }

    protected function ReturnTransactionCashIn($request){
        $transaction                        = new Transaction();
        $transaction->date                  = Carbon::now()->toDateString();
        $transaction->transaction_code      = TransactionCode();
        $transaction->narration             = 'Return Items Transaction';
        $transaction->invoice_no            = $request->invoice_no;
        $transaction->sale_id               = $request->sale_id;
        $transaction->customer_id           = $request->customer_id;
        $transaction->created_by            = Auth('web')->user()->id;

        if($request->payment_by == 'BANK'){
            $transaction->bank_id = $request->bank_id;
            $transaction->payment_by = 'BANK';
        } else {
            $transaction->payment_by = 'CASH';
        }

        $transaction->cash_in = $request->return_amount;
        $transaction->save();
    }

    protected function ReturnTransactionCashOut($request){
        $transaction                        = new Transaction();
        $transaction->date                  = Carbon::now()->toDateString();
        $transaction->transaction_code      = TransactionCode();
        $transaction->narration             = 'Return Items Given Amount';
        $transaction->invoice_no            = $request->invoice_no;
        $transaction->sale_id               = $request->sale_id;
        $transaction->customer_id           = $request->customer_id;
        $transaction->created_by            = Auth('web')->user()->id;

        if($request->payment_by == 'BANK'){
            $transaction->bank_id = $request->bank_id;
            $transaction->payment_by = 'BANK';
        } else {
            $transaction->payment_by = 'CASH';
        }

        $transaction->cash_out = $request->deposit_amount;
        $transaction->save();
    }
}
