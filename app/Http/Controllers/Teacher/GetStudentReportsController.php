<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class GetStudentReportsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $student)
    {
        $student_information = [
            'how_much_save' => $student->how_much_save,
            'information' => $student->information,
        ];

        $reports = Room::where('student_id',$student->id)->select([
            'student_id', 'teacher_id', 'type', 'teacher_report', 'created_at'
        ])->where('status','end')->with('teacher:id,first_name,last_name')->get();
    
        return response()->json([
            'student_information' => $student_information,
            'reports' => $reports,
        ]);
    }
}
