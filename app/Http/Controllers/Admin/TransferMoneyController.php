<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransferMoney;
use App\Models\User;
use Illuminate\Http\Request;

class TransferMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payments = new TransferMoney();
        $payments = $payments->with('user:id,first_name,last_name');
        $search = $request->input('query');

        if ($search != null){
            $payments->whereHas('user',function($q) use ($search){
                $q->whereRaw("concat(first_name, ' ', last_name) like '%".$search."%'");
            });
        }

        return $payments->paginate(10);
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
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransferMoney $money)
    {
        $update['is_done'] = $request->is_done;
        $update['done_date'] = (1 == $request->is_done) ? now() : null;

        if ($request->is_done == 1){
            User::where('id',$money->user_id)->decrement('money',$money->price);
            User::where('id',$money->user_id)->decrement('minutes',$money->minutes);
        }

        $money->update($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
