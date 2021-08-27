<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Traits\UserPaidSuccessfullyTrait;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class CheckPaypalController extends Controller
{
    use UserPaidSuccessfullyTrait;

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed                    $token
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $r, $token)
    {
        $paypalModule = new ExpressCheckout();

        $pay = Payment::where('invoice_id', $token)->first();

        $response = $paypalModule->getExpressCheckoutDetails($token);
        if (! isset($response['PAYERID'])) {
            $pay->update(['status' => 'cancelled']);

            return response()->json(['status' => 'Something happend.'], 500);
        }

        $cart = $pay->data;

        $result = $paypalModule->doExpressCheckoutPayment($cart, $token, $response['PAYERID']);

        if (! in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $pay->update(['status' => 'cancelled']);

            return response()->json(['status' => 'Something happend.'], 500);
        }
        if (in_array(strtoupper($result['PAYMENTINFO_0_PAYMENTSTATUS']), ['COMPLETED', 'COMPLETED_FUNDS_HELD'])) {
            $pay->update(['status' => 'accepted']);

            return $this->paid($pay);
        }
        $pay->update(['status' => 'cancelled']);

        return response()->json(['status' => 'Something happend.'], 500);
    }
}
