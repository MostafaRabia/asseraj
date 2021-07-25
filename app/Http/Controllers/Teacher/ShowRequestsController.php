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
        $get_reads = $request->user()->reads_save;

        return ModelsRequest::where(function ($query) use ($get_reads) {
            $query->whereIn('read', $get_reads)->orWhereHas('user', function ($query) use ($get_reads) {
                $query->whereIn('reads_save', $get_reads);
            });
        })->simplePaginate(5);
    }
}
