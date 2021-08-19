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
        $id = config('twilio.id');
        $token = config('twilio.token');
        $twilio = new Client($id, $token);
        
        $room = $twilio->video->v1->rooms($sid)
                                  ->update("completed");
        
        return $room->uniqueName;
    }
}
