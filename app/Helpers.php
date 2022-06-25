<?php

//check user access permission function start
use App\Models\UserManagement\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\UserManagement\SuperAdmin;
    function can($can){
        if( auth('web')->check() && auth('web')->user()->is_super_admin == false  ){
            foreach( auth('web')->user()->role->permission as $permission ){
                if( $permission->key == $can ){
                    return true;
                }
            }
            return false;
        }
        return back();
    }
    //check user access permission function end


    // Application Language
    function SetApplicationLanguage($lang){
        App::setLocale($lang);
        session()->put("lang_code",$lang);
        return redirect()->back();
    }

    // Bangla Number To English Number
    function BnToEn($number) {
        $bn_to_en = array('১' => '1', '২' => '2', '৩' => '3', '৪' => '4', '৫' => '5', '৬' => '6', '৭' => '7', '৮' => '8', '৯' => '9', '০' => '0');

        $en_number = strtr($number, $bn_to_en);
        return $en_number;
    }


?>
