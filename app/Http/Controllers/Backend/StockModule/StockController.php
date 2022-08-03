<?php

namespace App\Http\Controllers\Backend\StockModule;

use App\Http\Controllers\Controller;
use App\Models\PurchaseModule\Purchase;
use App\Models\PurchaseModule\PurchaseDetails;
use App\Models\SettingsModule\CompanyInfo;
use App\Models\StockModule\StockInOut;
use App\Models\SystemDataModule\Warehouse;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function stock_add()
    {
        if(can('stock_add')) {
            $purchases = Purchase::with('supplier')
                            ->where('status', 'PENDING')
                            ->orderBy('date', 'desc')
                            ->get();

            return view('backend.modules.stock_module.add_to_stock', compact('purchases'));
        }
    }

    public function add_to_stock($id)
    {
        if(can('stock_add')) {
            $warehouses = Warehouse::select('id', 'name')->where('is_active', true)->where('is_delete',false)->get();
            $purchase = Purchase::with('supplier')->find(decrypt($id));
            $purchase_details = PurchaseDetails::with('lot', 'item', 'unit', 'variant')->where('purchase_id', decrypt($id))->get();

            return view('backend.modules.stock_module.stock_entry', compact('purchase', 'purchase_details', 'warehouses'));
        } else {
            return view('errors.404');
        }
    }

    // Store to Stock
    public function store_to_stock(Request $request)
    {
        if(can('stock_add')) {

            foreach($request->item_id as $key => $item){
                $stock_in = new StockInOut();
                $stock_in->purchase_id = $request->purchase_id;
                $stock_in->item_id = $item;
                $stock_in->variant_id = $request->variant_id[$key];
                $stock_in->unit_id = $request->unit_id[$key];
                $stock_in->lot_id = $request->lot_id[$key];
                $stock_in->in_quantity = $request->in_quantity[$key];
                if($request->one_wearhouse){
                    $stock_in->warehouse_id = $request->one_warehouse_id;
                } else {
                    $stock_in->warehouse_id = $request->warehouse_id[$key];
                }
                $stock_in->save();
            }

            Purchase::where('id', $request->purchase_id)->update(['status' => 'STOCK_IN']);
            return redirect()->route('stock.add');

            // return $request->all();
        } else {
            return view('errors.404');
        }
    }

    //Stock Report
    public function stock_list(Request $request)
    {
        if(can('stock_list') || can('current_stock_report') || can('warehouse_wise_stock_report') || can('date_wise_stock_report')){


            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $stock = new StockInOut();
            $stock_lists = $stock->StockList();

            $warehouse = 'null';
            $stock_date = 'null';  

            if($request->warehouse_id) {
                $stock_lists = $stock->StockListByWarehouse($request->warehouse_id);
                $warehouse = $request->warehouse_id;
            }

            if($request->stock_date) {
                // return $request->stock_date;
                $date = explode('-', $request->stock_date);

                $start_date = Carbon::parse($date[0])->toDateString();
                $end_date = Carbon::parse($date[1])->toDateString();

                $stock_lists = $stock->StockListByDate($start_date, $end_date);
             
                $stock_date = $start_date. ' '.$end_date;               
            }

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB

            return view('backend.modules.stock_module.stock_list', compact('stock_lists', 'warehouse', 'stock_date'));
        }
    }

    //Stock Report export pdf
    public function stock_list_export_pdf($warehouse, $stock_date)
    {
        // return $stock_date;

        if(can('stock_list') || can('current_stock_report') || can('warehouse_wise_stock_report') || can('date_wise_stock_report')){


            config()->set('database.connections.mysql.strict', false); // Disable DB strict Mode
            DB::reconnect(); // Reconnect to DB

            $stock = new StockInOut();
            $stock_lists = $stock->StockList();

            if($warehouse != 'null') {
                $stock_lists = $stock->StockListByWarehouse($warehouse);
                $warehouse = $warehouse;
            }

            if($stock_date != 'null') {
                $date = explode(' ', $stock_date);

                $start_date = $date[0];
                $end_date = $date[1];

                $stock_lists = $stock->StockListByDate($start_date, $end_date);

                $stock_date = $stock_date;                
            }
                          

            config()->set('database.connections.mysql.strict', true); //Enable DB Strict Mode
            DB::reconnect(); //Reconnect to DB

            $company_info = CompanyInfo::first();
            $title = __('Stock.StockList');

            $now = new DateTime();
            $time = $now->format('F j, Y, g:i a');
            $auth_user = Auth::user()->name;

            $footer = "
                    <span style='margin: 29px;'>Page :
                    <span></span>{PAGENO} of {nbpg}</span>
                    &nbsp;
                    &nbsp;
                    &nbsp;

                    <span class='print_date'>Print Date : $time
                </span>

                &nbsp;
                &nbsp;
                &nbsp;
                <span class='print_by'>
                    Printed By : $auth_user
                </span>

                &nbsp;
                &nbsp;
                <span class='powered_by'> Powered By: RP AI Solutions </span>
                &nbsp;
                ";

            $mpdf = new \Mpdf\Mpdf(
                [
                    // 'default_font_size' => 12,
                    'default_font' => 'nikosh',
                    'mode' => 'utf-8',
                ]
            );

            $mpdf->SetTitle(__("Stock.StockList"));
            $mpdf->SetFooter($footer);
            $mpdf->WriteHTML(view('backend.modules.stock_module.export.pdf.stock_list_export_pdf', compact(
                'stock_lists',
                'company_info',
                'title'
            )));
            $mpdf->Output("StockList".'.pdf', "I");
        }
    }



}
