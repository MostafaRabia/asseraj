<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SuperVisorRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperVisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = new User();
        $user = $user->select(['id', 'first_name', 'last_name', 'email'])->whereRoleIs('supervisor')->with('permissions');

        if ($request->input('query') != null){
            $user->whereRaw("concat(first_name, ' ', last_name) like '%".$request->input('query')."%'");
        }

        return $user->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuperVisorRequest $request)
    {
        $user = User::findByEmailSig($request->email);
        if (!$user){
            return response()->json(['error'=>'User not found.'],422);
        }

        $user->attachRole('supervisor');
        $user->syncPermissions($request->permissions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $supervisor)
    {
        return $supervisor->allPermissions();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuperVisorRequest $request, User $supervisor)
    {
        if (! $supervisor->hasRole('supervisor')) {
            $supervisor->attachRole('supervisor');
        }

        $supervisor->syncPermissions($request->permissions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $supervisor)
    {
        DB::table('permission_user')->where('user_id', $supervisor->id)->delete();
        $supervisor->detachRole('supervisor');
    }
}
