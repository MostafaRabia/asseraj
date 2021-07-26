<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Record;
use App\Models\Slide;
use Illuminate\Http\Request;

class GetIndexPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $slides = Slide::get();
        $records = Record::get();
        
        return response()->json([
            'slides' => $slides,
            'records' => $records,
            'about_us' => AboutUs::first(),
        ]);
    }
}
