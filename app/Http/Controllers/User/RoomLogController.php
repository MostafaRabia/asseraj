<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomLogController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Room::where('student_id', auth()->user()->id)->with('teacher:id,first_name,last_name')->orderBy('id','desc')->paginate(7);
    }
}
