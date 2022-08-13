<?php

namespace App\Http\Controllers\Backend\CustomerModule;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerModule\Customer;
use App\Models\TransactionModule\Transaction;
use Carbon\Carbon;
use App\Models\StockModule\StockInOut;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if( can('all_customer') || can('all_customer_report') ){

            $append = [];


            $customers = Customer::with('transactions')->select('id', 'name', 'contact_no', 'is_active')->orderBy('id', 'desc');

            if ($request->customer_search != null) {
                $customers = $customers->where(function ($query) use($request) {
                                        $query->where('name', 'like', '%' . $request->customer_search . '%')
                                        ->orWhere('contact_no', 'like', '%' . $request->customer_search . '%');
                                    });
                $append['customer_search'] = $request->customer_search;
            }

            $customers = $customers->paginate(10)->appends($append);

            return view('backend.modules.customer_module.index', compact('customers'));

        } else {
            return view("errors.404");
        }
    }

    //customer add modal start
    public function add_modal(){
        if( can('add_customer') ){
            return view("backend.modules.customer_module.modals.add");

        } else{
            return view("errors.404");
        }
    }

    //add customer start
    public function add(Request $request){

        if( can('add_customer') ){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                'address' => 'nullable|max:2000',
                'remarks' => 'nullable|max:2000',
                'opening_balance' => 'required',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()] ,422);
            }else{
                try{
                    $customer = new Customer();
                    $customer->name = $request->name;
                    $customer->contact_no  = $request->phone;
                    $customer->address = $request->address;
                    $customer->remarks = $request->remarks;
                    $customer->is_active = true;

                    if( $customer->save() ){

                        $today = Carbon::now();
                        if($request->opening_balance){
                            $transaction = new Transaction();
                            $transaction->date = $today->toDateString();
                            $transaction->transaction_code = $today.'OP#CUSTOMER';
                            $transaction->narration = 'OPENING BALANCE';
                            $transaction->customer_id = $customer->id;
                            $transaction->remarks = 'Opening Balance of '.$customer->name;
                            $transaction->cash_in = BnToEn($request->opening_balance);
                            $transaction->created_by = auth('web')->user()->id;
                            $transaction->save();
                        }

                        return response()->json(['customer_add' => __('Customer.CustomerAddSuccessMsg')], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
            }
        }else{
            return view("errors.404");
        }
    }

    //customer show modal start
    public function show($id){
        if( can("view_customer") || can('all_customer_report')){
            $customer = Customer::where("id",$id)->select("id", "name", "contact_no", 'address', 'remarks', "is_active")->first();

            return view("backend.modules.customer_module.modals.show", compact("customer"));
        }
        else{
            return view("errors.404");
        }
    }

    //customer edit modal start
    public function edit($id){
        if( can("edit_customer") ){
            $customer = Customer::where("id",$id)->select("id", "name", "contact_no", 'address', 'remarks', "is_active")->first();

            return view("backend.modules.customer_module.modals.edit", compact("customer"));
        }
        else{
            return view("errors.404");
        }
    }

    //customer update modal start
    public function update(Request $request, $id){
        if( can('edit_customer')){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
                'address' => 'nullable|max:2000',
                'remarks' => 'nullable|max:2000',
            ]);

            if( $validator->fails() ){
                return response()->json(['errors' => $validator->errors()] ,422);
            }else{
                try{
                    $customer = Customer::find($id);
                    $customer->name = $request->name;
                    $customer->contact_no  = $request->phone;
                    $customer->address = $request->address;
                    $customer->remarks = $request->remarks;
                    $customer->is_active = true;

                    if( $customer->update() ){
                        return response()->json(['customer_update' => __('Customer.CustomerUpdateMsg')], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
            }
        }else{
            return view("errors.404");
        }
    }
}
