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
        $get_reads = array_merge($request->user()->reads_save,$request->user()->reads_learning);

        return ModelsRequest::where(function ($query) use ($get_reads) {
            $query->whereIn('read', $get_reads);
        })->simplePaginate(5);
    }
}
