<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $r)
    {
        $create = $r->validated();
        $create['ip'] = $r->ip();

        $created = User::create($create);
        $created->attachRole('user');
        // event(new Registered($created));

        return response()->json(['status' => 'done','token'=>$created->createToken('login')->plainTextToken,'name'=>$created->full_name,'image'=>$created->image]);
    }
}
