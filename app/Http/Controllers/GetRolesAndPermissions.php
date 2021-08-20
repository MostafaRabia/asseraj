<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetRolesAndPermissions extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->json([
            'roles' => $request->user()->roles()->pluck('name'),
            'permissions' => $request->user()->permissions()->pluck('name'),
        ]);
    }
}
