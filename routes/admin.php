<?php

use Illuminate\Support\Facades\Route;

$exp = 'ability:admin';

Route::get('notifications','GetNotificationsController');

Route::group(['middleware'=>[$exp.',outer_pages']],function(){
    Route::apiResource('about/us','AboutUsController');

    Route::apiResource('records','RecordsController');

    Route::apiResource('slides','SlidesController');

    Route::apiResource('website/setting','WebsiteSettingController');
});

Route::group(['middleware'=>[$exp.',contact_us'],'as'=>'contact'],function(){
    Route::apiResource('contact/us','ContactUsController');

    Route::put('showed/contact/{us}','UpdateContactUsToShowedController');

    Route::put('accept/user/{user}','AcceptOrRefuseTeacherController')->name('accept.user');
});

Route::group(['middleware'=>[$exp.',transfer_money']],function(){
    Route::apiResource('payments','PaymentsController')->except(['show']);

    Route::apiResource('transfer/money','TransferMoneyController');

    Route::apiResource('vf/cash','VCController');
});

Route::apiResource('students','StudentsController')->middleware($exp.',students');

Route::apiResource('teachers','TeachersController')->middleware($exp.',teachers');

Route::apiResource('supervisor','SuperVisorController')->middleware($exp.',permissions');

Route::get('calc/money','CalcMoneyController');

Route::get('logs/room','RoomLogController');
Route::get('logs/payments','PaymentLogController');