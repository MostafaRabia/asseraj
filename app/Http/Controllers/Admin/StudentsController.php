<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = new User();
        $user = $user->select(['id', 'first_name', 'last_name'])->whereRoleIs('user');

        if ($request->input('query') != null){
            $user->whereRaw("concat(first_name, ' ', last_name) like '%".$request->input('query')."%'");
        }

        return $user->orderBy('id','desc')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        return $student->only([
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
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        Storage::delete($student->image);
        $student->delete();
    }
}
