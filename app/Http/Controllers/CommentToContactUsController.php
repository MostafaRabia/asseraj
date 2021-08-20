<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class CommentToContactUsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, ContactUs $us)
    {
        $comment = $us->comments()->create([
            'comment' => links_newlines_text($request->comment),
            'user_id' => $request->user()->id,
        ]);

        return $comment;
    }
}
