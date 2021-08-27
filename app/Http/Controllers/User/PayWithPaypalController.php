<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PayWithPaypalRequest;
use App\Models\Payment;
use App\Models\Plan;
use App\Traits\CurrencyTrait;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayWithPaypalController extends Controller
{

    use CurrencyTrait;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PayWithPaypalRequest $request)
    {
        $plan = Plan::select(['minutes','price'])->find($request->plan_id);
        $total = number_format($this->getCurrency('EGP','USD') * $plan->price, 2);

        $data['items'] = [
            [
                'name' => 'شراء '.$plan->minutes.' دقيقة في السراج المنير',
                'price' => $total,
                'desc' => 'شراء '.$plan->minutes.' دقيقة في السراج المنير',
                'qty' => 1,
            ],
        ];
        $data['invoice_id'] = $this->rand_invoice_id();
        $data['invoice_description'] = "Order #{$data['invoice_id']} Bill";
        $data['return_url'] = config('app.front_url').'/check/paypal/payment';
        $data['cancel_url'] = config('app.front_url').'/check/paypal/payment';
        $data['total'] = $total;

        $paypalModule = new ExpressCheckout();

        $res = $paypalModule->setExpressCheckout($data);

        if (in_array(strtoupper($res['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            Payment::create(array_merge($request->all(), [
                'invoice_id' => $res['TOKEN'],
                'price' => $plan->price,
                'minutes' => $plan->minutes,
                'data' => $data,
            ]));
            return response()->json([
                'link' => $res['paypal_link'],
            ]);
        }

        \Log::info($res);
    }

    protected function rand_invoice_id()
    {
        while (true) {
            $str = \Str::random(16);
            if (! Payment::where('invoice_id', $str)->exists()) {
                return $str;
            }
        }
    }
}
