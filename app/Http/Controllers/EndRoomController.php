<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndRoomRequest;
use App\Jobs\UpdateRate;
use App\Models\Room;
use Illuminate\Http\Request;

class EndRoomController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(EndRoomRequest $request, Room $room)
    {
        $user = $request->user();
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

        if ($request->has('teacher_rate') && 0 != $request->teacher_rate) {
            UpdateRate::dispatch('teacher_id', $room->teacher_id);
        }

        if ($request->has('student_rate') && 0 != $request->student_rate) {
            UpdateRate::dispatch('student_id', $room->student_id);
        }

        if ($user->hasRole('teacher')) {
            $user->increment('minutes', $room->time);
            $user->increment('money', ($room->time * $user->price_of_minute));
        } else {
            if ($room->time >= $user->minutes) {
                $user->update(['minutes' => 0]);
            } else {
                $user->decrement('minutes', $room->time);
            }
        }
    }
}
