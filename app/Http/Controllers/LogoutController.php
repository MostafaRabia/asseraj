<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $r){
        if (auth()->check()) {
            $r->user()->currentAccessToken()->delete();
        }
    }
}
