<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class EndRoomConrtoller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,$sid)
    {
        $sid = 'AC8226bffaccf865f94ede8f3cd969afd3';
        $token = '00020b48427a874c4e309c8cb76d4cbf';
        $twilio = new Client($sid, $token);
        
        $room = $twilio->video->v1->rooms($sid)
                                  ->update("completed");
        
        return $room->uniqueName;
    }
}
