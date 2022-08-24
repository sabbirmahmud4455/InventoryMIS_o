<?php

//check user access permission function start
use App\Models\UserManagement\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\UserManagement\SuperAdmin;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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

    // MySQL Stric Method Disable for Query Executions
    function DisableDBStrictMode()
    {
        config()->set('database.connections.mysql.strict', false);
        DB::reconnect();
    }

    // MySQL Stric Method Enable for Query Executions
    function EnableDBStrictMode()
    {
        config()->set('database.connections.mysql.strict', true);
        DB::reconnect();
    }

    // Generate Unique Transaction Code
    function TransactionCode()
    {
        $now = Carbon::now();
        $day = $now->day;
        $month = $now->month;
        $year = $now->year;

        if($day <= 9){
            $day = '0'.$day;
        }
        if($month <= 9){
            $month = '0'.$month;
        }

        return $day.$month.$year.'#'.rand ( 10000 , 99999 );
    }


?>
