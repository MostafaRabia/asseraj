<?php

namespace App\Http\Controllers\Admin;

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
        $arr = [
            'teacher' => 'teacher_id',
            'student' => 'student_id'
        ];

        return Room::where($arr[$request->type],$request->user_id)->with(['student:id,first_name,last_name','teacher:id,first_name,last_name'])->paginate(7);
    }
}
