<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class AcceptRequestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ModelsRequest $model_request)
    {
        $old_request = $model_request;
        $model_request->delete();

        $created = Room::create([
            'student_id' => $old_request->user_id,
            'teacher_id' => auth()->user()->id,
            'type' => $old_request->type,
            'time' => 0,
            'status' => 'open',
        ]);

        return response()->json(['status' => 'done', 'room_id' => $created->id]);
    }
}
