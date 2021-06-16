<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResendVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $r)
    {
        $r->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'done']);
    }
}
