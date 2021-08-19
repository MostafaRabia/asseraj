<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'is_active_teacher'],function(){
    Route::get('requests','ShowRequestsController');
    Route::get('logs/room','RoomLogController');
    Route::get('check/room', 'CheckRoomController');
    Route::get('student/reports/{student}','GetStudentReportsController');
    Route::get('check/vector/request','CheckIfThereVectorRequestController');

    Route::put('accept/request/{model_request}','AcceptRequestController');
    Route::put('end/room/{sid}','EndRoomConrtoller');

    Route::post('request/my/money','RequestMoneyController');

    Route::delete('requset/{request}','CancelRequestController');
});