<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckRequestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if(!DB::table('requests')->where('user_id', auth()->user()->id)->exists() && !DB::table('rooms')->where('student_id', auth()->user()->id)->where('status', 'open')->exists()){
            return response()->json(['status'=>'failed'],422);
        }else{
            return response()->json(['status'=>'done','request'=>'has requested.']);
        }
    }
}
