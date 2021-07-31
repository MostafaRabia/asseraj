<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTeacherRequest;
use App\Models\ContactUs;
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

        User::create($create);
        // event(new Registered($created));

        ContactUs::create([
            'name' => $create['first_name'].' '.$create['last_name'],
            'email' => $create['email'],
            'phone' => $create['phone'],
            'subject' => 'تسجيل معلم جديد',
            'message' => 'تسجيل معلم جديد، انظر المعلمين.',
        ]);

        return response()->json(['status' => 'done']);
    }
}
