<?php

namespace App\Http\Controllers\Backend\SettingsModule;

use App\Http\Controllers\Controller;
use App\Models\SettingsModule\CompanyInfo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CompanyInfoController extends Controller
{
    //index function start
    public function index()
    {
        if (can('company_info')) {
            $company_info = CompanyInfo::first();
            if($company_info) {
                return view('backend.modules.setting_module.company_info.index',compact('company_info'));
            }
            else {
                return view('errors.404');
            }
        } else {
            return view("errors.404");
        }
    }
    //index function end

    //update function start
    public function update(Request $request, $id){
        if( can("edit_company_info") ){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required|email',
                'website' => 'required',
                'web_mail' => 'required',
                'facebook_profile' => 'required',
                'linkedin_profile' => 'required',
                'youtube_profile' => 'required',
                'description' => 'required',
                ]);
            if ( $validator->fails() )
            {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            else
            {
                try{
                    $company_info = CompanyInfo::findOrFail(decrypt($id));

                    $company_info->name = $request->name;
                    $company_info->address = $request->address;
                    $company_info->phone = $request->phone;
                    $company_info->email = $request->email;
                    $company_info->website = $request->website;
                    $company_info->web_mail = $request->web_mail;
                    $company_info->facebook_profile = $request->facebook_profile;
                    $company_info->linkedin_profile = $request->linkedin_profile;
                    $company_info->youtube_profile = $request->youtube_profile;
                    $company_info->description = $request->description;

                    if( $request->company_logo ){
                        if( File::exists('images/company_info/'. $company_info->company_logo) ){
                            File::delete('images/company_info/'. $company_info->company_logo);
                        }
                        $image = $request->file('company_logo');
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/company_info/'.$img);
                        Image::make($image)->save($location);
                        $company_info->company_logo = $img;
                    }

                    if( $request->reporting_logo ){
                        if( File::exists('images/company_info/'. $company_info->reporting_logo) ){
                            File::delete('images/company_info/'. $company_info->reporting_logo);
                        }
                        $image = $request->file('reporting_logo');
                        $img = time().Str::random(12).'.'.$image->getClientOriginalExtension();
                        $location = public_path('images/company_info/'.$img);
                        Image::make($image)->save($location);
                        $company_info->reporting_logo = $img;
                    }

                    if( $company_info->save() ){
                        return response()->json(['success' => 'Company Info Updated'], 200);
                    }

                }
                catch( Exception $e ){
                    return response()->json(['error' => $e->getMessage()], 200);
                }
            }
        }
        else{
            return response()->json(['warning' => 'Unauthorized request'], 200);
        }
    }
    //update function end
}
