<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\Supplier;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        if( can('supplier') ){
            $suppliers = Supplier::select('id', 'name', 'contact_no', 'is_active')->orderBy('id', 'desc')->paginate(20);

            return view('backend.modules.system_data_module.supplier.index', compact('suppliers'));

        } else {
            return view("errors.404");
        }
    }

    //supplier add modal start
    public function add_modal(){
        if( can('add_supplier') ){
            return view("backend.modules.system_data_module.supplier.modals.add");

        } else{
            return view("errors.404");
        }
    }

    //add supplier start
    public function add(Request $request){

        if( can('add_supplier') ){
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
                    $supplier = new Supplier();
                    $supplier->name = $request->name;
                    $supplier->contact_no  = $request->phone;
                    $supplier->address = $request->address;
                    $supplier->remarks = $request->remarks;
                    $supplier->is_active = true;

                    if( $supplier->save() ){

                        return response()->json(['supplier_add' => __("Supplier.SupplierAddSuccessMsg")], 200);
                    }

                }catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()],200);
                }
            }
        }else{
            return view("errors.404");
        }
    }

    //supplier show modal start
    public function show($id){
        if( can("view_supplier")){
            $supplier = Supplier::where("id",$id)->select("id", "name", "contact_no", 'address', 'remarks', "is_active")->first();

            return view("backend.modules.system_data_module.supplier.modals.show", compact("supplier"));
        }
        else{
            return view("errors.404");
        }
    }

    //supplier edit modal start
    public function edit($id){
        if( can("edit_supplier") ){
            $supplier = Supplier::where("id",$id)->select("id", "name", "contact_no", 'address', 'remarks', "is_active")->first();

            return view("backend.modules.system_data_module.supplier.modals.edit", compact("supplier"));
        }
        else{
            return view("errors.404");
        }
    }

    //supplier update modal start
    public function update(Request $request, $id){
        if( can('edit_supplier')){
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
                    $supplier = Supplier::find($id);
                    $supplier->name = $request->name;
                    $supplier->contact_no  = $request->phone;
                    $supplier->address = $request->address;
                    $supplier->remarks = $request->remarks;
                    $supplier->is_active = true;

                    if( $supplier->update() ){
                        return response()->json(['supplier_update' => __('Supplier.SupplierUpdateMsg')], 200);
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
