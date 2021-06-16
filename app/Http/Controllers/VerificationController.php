<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function __construct(Request $request){
        Auth::loginUsingId($request->route('id'));
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return response()->json(['status'=>'done']);
    }
}