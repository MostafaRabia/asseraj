<?php

use Illuminate\Support\Facades\Route;

$exp = 'ability:admin';

Route::get('notifications','GetNotificationsController');

Route::group(['middleware'=>[$exp.',outer_pages']],function(){
    Route::apiResource('about/us','AboutUsController');

    Route::apiResource('records','RecordsController');

    Route::apiResource('slides','SlidesController');
});

Route::group(['middleware'=>[$exp.',contact_us']],function(){
    Route::get('contact/us','GetContactUsController');

    Route::put('showed/contact/{us}','UpdateContactUsToShowedController');
});

Route::group(['middleware'=>[$exp.',transfer_money']],function(){
    Route::get('payments','PaymentsController');

    Route::apiResource('transfer/money','TransferMoneyController');

    Route::apiResource('vf/cash','VCController');
});

Route::apiResource('students','StudentsController')->middleware($exp.',students');

Route::apiResource('teachers','TeachersController')->middleware($exp.',teachers');

Route::apiResource('supervisor','SuperVisorController')->middleware($exp.',permissions');