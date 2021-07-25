<?php

use Illuminate\Support\Facades\Route;

Route::get('requests','ShowRequestsController');
Route::get('logs/room','RoomLogController');

Route::put('accept/request/{model_request}','AcceptRequestController');