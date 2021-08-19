<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $r){
        $header = $r->header('Authorization');
        preg_match('/(\d+)\|/',$header,$match);
        $id = $match[1];

        $r->user()->tokens()->where('id',$id)->delete();
    }
}
