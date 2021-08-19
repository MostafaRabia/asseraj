<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $r){
        \Log::info($r->header('Authorization'));
        \Log::info($r->user()->tokens());
        $r->user()->tokens()->delete();
    }
}
