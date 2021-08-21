<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\TransferMoney;
use Illuminate\Http\Request;

class RequestMoneyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return TransferMoney::updateOrCreate(['user_id'=>$request->user()->id,'is_done'=>0],['price'=>$request->user()->money, 'minutes'=>$request->user()->minutes]);
    }
}
