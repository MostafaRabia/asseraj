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
        unset($create['password'],$create['id_photo']);

        if ($request->has('password') && (null != $request->password || '' != $request->password || !empty($request->password))) {
            $create['password'] = $request->password;
        }

        $create['id_photo'] = null;
        if ($request->hasFile('id_photo')) {
            $create['id_photo'] = $request->id_photo->store('ids');
        }
        User::create($create);

        return response()->json(['status' => 'done']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('permissions');

        return $user->only([
            'id', 'first_name', 'last_name',
            'gender', 'age', 'country',
            'state', 'city', 'email',
            'phone', 'reads_save', 'reads_learning',
            'price_of_minute', 'from', 'to',
            'vf_cash', 'bank_account', 'name_of_bank',
            'national_id', 'id_photo',
            'facebook', 'twitter', 'google',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EditTeacherRequest $request, User $user)
    {
        $update = $request->validated();
        unset($update['password'],$update['id_photo']);

        if ($request->has('password') && (null != $request->password || '' != $request->password || !empty($request->password))) {
            $update['password'] = $request->password;
        }

        $update['id_photo'] = null;
        if ($request->hasFile('id_photo')) {
            $update['id_photo'] = $request->id_photo->store('ids');
        }
        $user->update($update);

        return response()->json(['status' => 'done']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete($user->image);
        $user->delete();
    }
}
