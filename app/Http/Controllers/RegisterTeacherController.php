<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTeacherRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterTeacherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterTeacherRequest $r)
    {
        $create = $r->validated();
        $create['ip'] = $r->ip();
        $create['is_activated'] = 0;

        $created = User::create($create);
        $created->attachRole('user');
        // event(new Registered($created));

        return response()->json(['status' => 'done']);
    }
}
