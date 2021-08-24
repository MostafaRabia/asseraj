<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $payments = new Payment();
        $payments = $payments->with('user:id,first_name,last_name');
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
}
