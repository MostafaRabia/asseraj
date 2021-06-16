<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileRequest;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ProfileRequest $request)
    {
        $update = $request->except('password');

        if ($request->has('password') && (null != $request->password || '' != $request->password || !empty($request->password))) {
            $update['password'] = $request->password;
        }

        $request->user()->update($update);
    }
}
