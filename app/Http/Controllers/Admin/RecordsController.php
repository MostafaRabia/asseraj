<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RecordRequest;
use App\Models\Record;
use Illuminate\Support\Facades\Storage;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Record::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RecordRequest $request)
    {
        return Record::create([
            'name' => $request->name,
            'record' => $request->record->store('records'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        return $record;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(RecordRequest $request, Record $record)
    {
        return $record->update([
            'name' => $request->name,
            'record' => $request->record->store('records'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        Storage::delete($record->record);
        $record->delete();
    }
}
