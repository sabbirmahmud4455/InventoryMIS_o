<?php

namespace App\Http\Controllers\Backend\CustomerModule;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerModule\Customer;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        if( can('all_customer') ){
            $customers = Customer::select('id', 'name', 'contact_no', 'is_active')->orderBy('id', 'desc')->paginate(20);

            return view('backend.modules.system_data_module.customer.index', compact('customers'));

        } else {
            return view("errors.404");
        }
    }

    //customer add modal start
    public function add_modal(){
        if( can('add_customer') ){
            return view("backend.modules.system_data_module.customer.modals.add");

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
        if( can("view_customer")){
            $customer = Customer::where("id",$id)->select("id", "name", "contact_no", 'address', 'remarks', "is_active")->first();

            return view("backend.modules.system_data_module.customer.modals.show", compact("customer"));
        }
        else{
            return view("errors.404");
        }
    }

    //customer edit modal start
    public function edit($id){
        if( can("edit_customer") ){
            $customer = Customer::where("id",$id)->select("id", "name", "contact_no", 'address', 'remarks', "is_active")->first();

            return view("backend.modules.system_data_module.customer.modals.edit", compact("customer"));
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
