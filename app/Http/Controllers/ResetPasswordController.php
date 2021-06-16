<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ResetPasswordRequest $r)
    {
        $status = Password::reset(
            $r->only('emailsig', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password,
                ])->save();

                $user->setRememberToken(Str::random(60));
            }
        );

        return Password::PASSWORD_RESET == $status ? response()->json(['status' => 'done']) : response()->json(['status' => 'fail'], 500);
    }
}
