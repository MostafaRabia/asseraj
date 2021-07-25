<?php

namespace App\Http\Controllers;

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
        $update = $request->validated();
        unset($update['image'],$update['password']);

        if ($request->has('password') && (null != $request->password || '' != $request->password || !empty($request->password))) {
            $update['password'] = $request->password;
        }

        if ($request->hasFile('image')) {
            $update['image'] = $request->image->store('images');
        }

        $request->user()->update($update);
    }
}
