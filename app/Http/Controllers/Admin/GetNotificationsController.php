<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\TransferMoney;
use Illuminate\Http\Request;

class GetNotificationsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response()->json([
            'money_transfer' => TransferMoney::where('is_done', 0)->count(),
            'contact_us' => ContactUs::where('is_showed', 0)->count(),
        ]);
    }
}
