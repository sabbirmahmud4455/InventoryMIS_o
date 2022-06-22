<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

//login route start
Route::get('/', [LoginController::class, 'login_show'])->name('login.show');
Route::post('/do-login', [LoginController::class, 'do_login'])->name('do.login');
//login route end

//forget password route start
Route::get('/forget-password', [ForgetPasswordController::class, 'getEmail'])->name('get.email');
Route::post('/forget-password', [ForgetPasswordController::class, 'postEmail'])->name('post.email');
Route::get('reset-password/{token}/{email}', [ForgetPasswordController::class, 'getPassword'])->name('get.password');
Route::post('reset-password/{email}', [ForgetPasswordController::class, 'reset_password'])->name('password.reset');
//forget password route end

//logout route start
Route::post('/do-logout', [LogoutController::class, 'do_logout'])->name('do.logout');
//logout route end


//backend route group start
Route::group(['prefix' => 'admindashboard', 'middleware' => ['auth', 'Language']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    //profile module routes start
    Route::group(['prefix' => 'profile_module'], function () {
        require_once 'profile_module/profile.php';
    });
    //profile module routes end

    //user module routes start
    Route::group(['prefix' => 'user_module'], function(){
        require_once 'user_module/user.php';
        require_once 'user_module/role.php';
    });
    //user module routes end

    //settings module routes start
    Route::group(['prefix' => 'settings_module'], function () {
        require_once 'settings_module/app_info.php';
    });
    //settings module routes end


    // System Data
    Route::group(['prefix' => 'system-data'], function(){
        require_once 'system_data_module/item_type.php';
        require_once 'system_data_module/warehouse.php';
        require_once 'system_data_module/payment_type.php';
        require_once 'system_data_module/transaction_type.php';
    });

});
//backend route group end

?>
