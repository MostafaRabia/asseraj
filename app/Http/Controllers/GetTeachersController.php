<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetTeachersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $get_teachers = User::select(['first_name','last_name','image','description'])->whereRoleIs('teacher')->wherePermissionIs($request->permission)->get();

        return response()->json([
            'teachers' => $get_teachers,
            'count_teachers' => User::whereRoleIs('teacher')->wherePermissionIs('show_in_teachers')->count(),
            'count_saves' => User::whereRoleIs('teacher')->wherePermissionIs('show_in_saves')->count(),
            'count_students' => User::whereRoleIs('user')->count(),
        ]);
    }
}
