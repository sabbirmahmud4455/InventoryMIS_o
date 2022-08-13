<?php

namespace App\Http\Controllers\Backend\ReturnModule;

use App\Http\Controllers\Controller;
use App\Models\BankModule\Bank;
use App\Models\PurchaseModule\Purchase;
use App\Models\ReturnModule\ItemReturn;
use App\Models\SaleModule\Sale;
use App\Models\StockModule\StockInOut;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function customer_return_view(Request $request)
    {
        if(can('customer_return')) {
            $sale_id = $request->customer_sale_id;

            DisableDBStrictMode();

            $sale = new Sale();
            $sale_info = $sale->SaleDetails($sale_id);

            $bank = new Bank();
            $banks = $bank->AllBanksWithBalance();

            $transaction = new Transaction();
            $total_amount = $transaction->TotalCashInHandAndBankBalance();


            EnableDBStrictMode();



            return view('backend.modules.return_module.sale_return.sale_return_view', compact('sale_info', 'banks', 'total_amount'));
        } else {
            return view('errors.404');
        }
    }

    // Customer Return Store
    public function customer_return_store(Request $request)
    {
        if(can('customer_return')) {
            // return $request->all();
            $this->ItemReturnStore($request);

        } else {
            return view('errors.404');
        }
    }

    protected function ItemReturnStore($request){

        $item_return = new ItemReturn();
        $item_return->sale_id = $request->sale_id;
        $item_return->invoice_no = $request->invoice_no;
        $item_return->return_amount = $request->return_amount;
        if($request->adjust == 1){
            $item_return->status = 'AdjustWithStock';
            $this->AdjustWithStock($request);
        } else {
            $item_return->status = 'Wastage';
        }

        if($request->return_amount) {
            $this->ReturnTransaction($request);
        }

        if($item_return->save()){
            return $item_return;
        }
    }

    protected function AdjustWithStock($request){
        $date = Carbon::now();
        $today = $date->toDateString();

        foreach($request->item_id as $key => $item){
            $stock_in = new StockInOut();
            $stock_in->date = $today;
            $stock_in->sale_id = $request->sale_id;
            $stock_in->item_id = $item;
            $stock_in->variant_id = $request->variant_id[$key];
            $stock_in->unit_id = $request->unit_id[$key];
            $stock_in->out_quantity = $request->return_quantity[$key];
            $stock_in->warehouse_id = 1;
            $stock_in->lot_id = 1;

            $stock_in->save();
        }
    }

    protected function ReturnTransaction($request){
        $transaction = new Transaction();
        $transaction->date = Carbon::now()->toDateString();
        $transaction->transaction_code = '001225';
        $transaction->narration = 'Return Items Transaction';
        $transaction->invoice_no = $request->invoice_no;
        $transaction->sale_id = $request->sale_id;

        if($request->payment_by == 'BANK'){
            $transaction->bank_id = $request->bank_id;
            $transaction->payment_by = 'BANK';
        } else {
            $transaction->payment_by = 'CASH';
        }

        $transaction->cash_out = $request->return_amount;
        $transaction->save();
    }
}
