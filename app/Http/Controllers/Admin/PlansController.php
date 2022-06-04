<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentsRequest;
use App\Models\Plan;

class PlansController extends Controller
{
    public function index()
    {
        return Plan::get();
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
