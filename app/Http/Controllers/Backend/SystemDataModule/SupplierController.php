<?php

namespace App\Http\Controllers\Backend\SystemDataModule;

use Exception;
use Illuminate\Http\Request;
use App\Models\UserModule\Role;
use App\Http\Controllers\Controller;
use App\Models\SystemDataModule\Supplier;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        if( can('supplier') ){

            return view('backend.modules.system_data_module.supplier.index');

        } else {
            return view("errors.404");
        }
    }

    //user add modal start
    public function add_modal(){
        if( can('add_supplier') ){
            $roles = Role::where("id","!=",1)->where("is_active",true)->get();
            return view("backend.modules.system_data_module.supplier.modals.add",compact('roles'));

        } else{
            return view("errors.404");
        }
    }

    //data start
    public function data(){
        if( can('all_user') ){
            if( auth('web')->check() ){
                $user = User::orderBy('id', 'desc')
                ->where("id","!=",auth('web')->user()->id)
                ->where("is_super_admin",false)
                ->select("id","name","email","role_id","phone","is_active","image")->get();
            }
            return DataTables::of($user)
            ->rawColumns(['action', 'is_active','permission','name','type'])
            ->editColumn('name', function(User $user){
                if( $user->image == null ){
                    $src = asset("images/profile/user.png");
                }
                else{
                    $src = asset("images/profile/".$user->image);
                }


                return "
                    <img src='$src' width='50px' style='border-radius: 100%'>
                    <p> <b>Name :</b> $user->name</p>
                    <p><b>Email :</b> $user->email</p>
                    <p><b>Phone :</b> $user->phone</p>
                ";
            })
            ->editColumn('type', function (User $user) {
                return $user->role->name;
            })
            ->editColumn('is_active', function (User $user) {
                if ($user->is_active == true) {
                    return '<p class="badge badge-success">Active</p>';
                } else {
                    return '<p class="badge badge-danger">Inactive</p>';
                }
            })
            ->addColumn('action', function (User $user) {
                return '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown'.$user->id.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown'.$user->id.'">

                        '.( can("reset_password") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('user.reset.modal',$user->id).'" data-target="#myModal" data-toggle="modal">
                            <i class="fas fa-key"></i>
                            Reset Password
                        </a>
                        ': '') .'

                        '.( can("edit_user") ? '
                        <a class="dropdown-item" href="#" data-content="'.route('user.edit',$user->id).'" data-target="#myModal" class="btn btn-outline-dark" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                            Edit User
                        </a>
                        ': '') .'

                    </div>
                </div>
                ';
            })
            ->make(true);
        }else{
            return view("errors.404");
        }
    }


    //add user start
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
                    $user = new Supplier();
                    $user->name = $request->name;
                    $user->contact_no  = $request->phone;
                    $user->address = $request->address;
                    $user->remarks = $request->remarks;
                    $user->is_active = true;

                    if( $user->save() ){
                        return response()->json(['success' => 'New Supplier Created Successfully'], 200);
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
