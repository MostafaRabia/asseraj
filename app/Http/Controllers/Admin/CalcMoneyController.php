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

        $paid = Payment::whereMonth('created_at',$now->month)->sum('price');
        $transferred = TransferMoney::whereMonth('created_at',$now->month)->where('is_done',1)->sum('price');

        return response()->json([
            'paid' => $paid,
            'transferred' => $transferred,
        ]);
    }
}
