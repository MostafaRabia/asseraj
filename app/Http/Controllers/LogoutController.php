<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $r){
        \Log::info($r->user()->currentAccessToken());
        $r->user()->currentAccessToken()->delete();
    }
}
