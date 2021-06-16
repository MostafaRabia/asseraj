<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $r)
    {
        $create = $r->validated();
        $email = $create['email'];
        $emailsig = $this->crcemail($email)[1];
        $password = $create['password'];

        $login = ['password' => $password, 'emailsig' => $emailsig];

        if (!Auth::attempt($login)) {
            return response()->json(['error' => 'email or password is invalid.'], 422);
        }

        $user = User::where('emailsig', $emailsig)->first();
        $user->update(['ip' => $r->ip()]);
        $return = [];

        // if (1 == $r->is_from_phone) {
        //     $return['token'] = $user->createToken('login-token')->plainTextToken;
        // }

        $return = array_merge($return, [
            'roles' => $user->roles()->pluck('name'),
            'permissions' => $user->permissions()->pluck('name'),
            'name' => $user->full_name,
            'is_email_verified' => $user->email_verified_at,
            'image' => $user->image,
            'id' => $user->id,
        ]);

        $r->session()->regenerate();

        return response()->json($return);
    }
}
