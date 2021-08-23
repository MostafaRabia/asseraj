<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AcceptOrRefuseTeacherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        if ($request->accept == 1){
            $user->attachRole('teacher');
            $user->update(['is_activated'=>1]);
        }else{
            $user->delete();
        }
    }
}
