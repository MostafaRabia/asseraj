<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class SendResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SendResetPasswordRequest $r)
    {
        $status = Password::sendResetLink(['emailsig' => $r->emailsig]);

        return Password::RESET_LINK_SENT === $status ? response()->json(['status' => 'done']) : response()->json(['status' => 'fail'], 500);
    }
}
