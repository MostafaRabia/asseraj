<?php

use Illuminate\Support\Facades\Route;

Route::post('request', 'RequestController');
Route::get('check/request','CheckRequestController');

Route::get('logs/room', 'RoomLogController');
Route::get('logs/payment', 'PaymentLogController');

Route::get('check/room', 'CheckRoomController');
