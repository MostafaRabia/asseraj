<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class GetLastTeachersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Room::select(['id','teacher_id'])->with('teacher:id,first_name,last_name,image')->where('student_id',$request->user()->id)->where('status','end')->latest()->take(20)->get();
    }
}
