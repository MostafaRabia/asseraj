<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsFromUserRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsFromUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ContactUs::where('user_id',auth()->user()->id)->paginate(7);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactUsFromUserRequest $request)
    {
        ContactUs::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $us)
    {
        $us->load('comments');
        return $us;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUsFromUserRequest $request, ContactUs $us)
    {
        $us->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $us)
    {
        $us->delete();
    }
}
