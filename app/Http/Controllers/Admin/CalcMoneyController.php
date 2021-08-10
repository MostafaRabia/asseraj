<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\TransferMoney;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalcMoneyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $now = Carbon::now();

        $all = Payment::where('status','accepted')->sum('price') - TransferMoney::where('is_done',1)->sum('price');
        $paid = Payment::whereMonth('created_at',$now->month)->where('status','accepted')->sum('price');
        $transferred = TransferMoney::whereMonth('created_at',$now->month)->where('is_done',1)->sum('price');

        return response()->json([
            'all' => $all,
            'paid' => $paid,
            'transferred' => $transferred,
        ]);
    }
}
