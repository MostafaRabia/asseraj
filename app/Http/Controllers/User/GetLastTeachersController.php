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
        $rooms = Room::select(['id','teacher_id'])->with(['teacher'=>function($q){
            $q->select(['id','first_name','last_name','image','is_online'])->orderBy('is_online','desc');
        }])->where('student_id',$request->user()->id)->where('status','end')->latest()->take(20)->get();

        $ids = [];
        $return = [];
        foreach($rooms as $room){
            if (!in_array($room->teacher_id,$ids)){
                $ids[] = $room->teacher_id;
                $return[] = $room;
            }
        }

        return $return;
    }
}
