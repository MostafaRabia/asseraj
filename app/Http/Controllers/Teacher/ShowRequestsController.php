<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class ShowRequestsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $teacher = $request->user();
        $get_reads = array_merge($teacher->reads_save ?: [],$teacher->reads_learning ?: []);
        $permissions = [
            'work_in_qra2at' => 'learn',
            'work_in_save' => 'check',
        ];
        $columns = [];

        foreach($permissions as $permission => $var){
            if ($teacher->hasPermission($permission)){
                $columns[] = $var;
            }
        }

        return ModelsRequest::where(function ($query) use ($get_reads) {
            $query->whereIn('read', $get_reads);
        })
        ->with('student:id,first_name,last_name,image')
        ->whereIn('type',$columns)
        ->orderBy('user_id','asc')
        ->simplePaginate(5);
    }
}
