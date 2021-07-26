<?php

namespace App\Http\Controllers\Teacher;

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
        return Room::where('teacher_id', auth()->user()->id)->where('status', 'open')->with('student')->first();
    }
}
