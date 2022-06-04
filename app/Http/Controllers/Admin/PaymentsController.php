<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentsRequest;
use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index(Request $request)
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

        return $payments->orderBy('id','desc')->paginate(10);
    }

    public function store(PaymentsRequest $request)
    {
        return Plan::create($request->safe()->toArray());
    }

    public function update(PaymentsRequest $request, Plan $plan)
    {
        $plan->update($request->safe()->toArray());

        return $plan;
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return $plan;
    }
}
