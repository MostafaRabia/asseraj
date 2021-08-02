<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditTeacherRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::select(['id', 'first_name', 'last_name', 'minutes'])->whereRoleIs('teacher')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EditTeacherRequest $request)
    {
        $create = $request->validated();
        unset($create['password'],$create['id_photo'],$create['permissions']);

        if ($request->has('password') && (null != $request->password || '' != $request->password || !empty($request->password))) {
            $create['password'] = $request->password;
        }

        $create['id_photo'] = null;
        if ($request->hasFile('id_photo')) {
            $create['id_photo'] = $request->id_photo->store('ids');
        }

        $create['ip'] = $request->ip();
        $create['timezone'] = $request->user()->timezone;

        $teacher = User::create($create);
        $teacher->attachRole('teacher');
        $teacher->syncPermissions($request->permissions);


        return response()->json(['status' => 'done']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $teacher)
    {
        $teacher->load('permissions');

        return $teacher;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EditTeacherRequest $request, User $teacher)
    {
        $update = $request->validated();
        unset($create['password'],$create['id_photo'],$create['permissions']);

        if ($request->has('password') && (null != $request->password || '' != $request->password || !empty($request->password))) {
            $update['password'] = $request->password;
        }

        $update['id_photo'] = null;
        if ($request->hasFile('id_photo')) {
            $update['id_photo'] = $request->id_photo->store('ids');
        }
        $teacher->update($update);
        $teacher->syncPermissions($request->permissions);

        return response()->json(['status' => 'done']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher)
    {
        Storage::delete($teacher->image);
        $teacher->delete();
    }
}
