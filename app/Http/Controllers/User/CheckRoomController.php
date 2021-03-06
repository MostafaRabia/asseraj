<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class CheckRoomController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Room::where('student_id', auth()->user()->id)->where('status', 'open')->with('teacher:id,first_name,last_name,image,age,information,description,country,state,city,phone,email,facebook,google,twitter,rate,from,to')->first();
    }
}
