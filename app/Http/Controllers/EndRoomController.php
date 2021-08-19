<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndRoomRequest;
use App\Jobs\UpdateRate;
use App\Models\Room;
use App\Models\User;

class EndRoomController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(EndRoomRequest $request, Room $room)
    {
        $arr = [
            'teacher_report',
            'teacher_rate',
            'student_rate',
        ];

        foreach ($arr as $input) {
            if ($request->has($input) && (null != $request->input || '' != $request->input || !empty($request->input))) {
                $update[$input] = $request->{$input};
            }
        }
        $update['status'] = 'end';

        $room->update($update);

        if (0 != $request->teacher_rate) {
            UpdateRate::dispatch('teacher_id', $room->teacher_id);
        }

        if (0 != $request->student_rate) {
            UpdateRate::dispatch('student_id', $room->student_id);
        }

        $student = User::find($room->student_id);
        $teacher = User::find($room->teacher_id);

        if ($room->time >= $student->minutes) {
            $student->update(['minutes' => 0]);
        } else {
            $student->decrement('minutes', $room->time);
        }

        $teacher->increment('minutes', $room->time);
        $teacher->increment('money', ($room->time * $teacher->price_of_minute));
    }
}
