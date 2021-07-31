<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PayWithVCRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PayWithVCController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PayWithVCRequest $request)
    {
        return Payment::create(array_merge($request->except('photo'),[
            'photo' => $request->photo->store('payments'),
        ]));
    }
}
