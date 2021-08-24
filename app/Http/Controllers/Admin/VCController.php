<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class VCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payments = new Payment();
        $payments = $payments->where('type','vf cash')->with('user:id,first_name,last_name');
        $search = $request->input('query');

        if ($search != null){
            $payments->where(function($q) use ($search){
                $q->whereHas('user',function($q) use ($search){
                    $q->whereRaw("concat(first_name, ' ', last_name) like '%".$search."%'");
                })->orWhere('invoice_id','LIKE',$search);
            });
        }

        return $payments->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $cash)
    {
        $cash->load('plan');
        return $cash;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $cash)
    {
        $cash->update(['status'=>$request->status,'price'=>$request->price]);

        if ($request->status==="accepted"){
            User::where('id',$cash->user_id)->update(['minutes'=>$cash->minutes]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $cash)
    {
        $cash->delete();
    }
}
