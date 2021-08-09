<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RequestRequest;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RequestRequest $request)
    {
        if ($request->type==="check"){
            $read = $request->user()->reads_save[0];
        }

        $created = ModelsRequest::create(array_merge(['user_id' => auth()->user()->id, 'read'=>$read], $request->all()));

        return response()->json(['status' => 'done','request' => $created]);
    }
}
