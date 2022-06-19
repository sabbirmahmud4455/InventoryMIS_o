<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function do_logout(Request $request)
    {
        if( auth('web')->check() ){
            Auth::logout();
        }

        return redirect()->route('login.show');
    }
}
