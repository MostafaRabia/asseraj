<?php

use Illuminate\Support\Facades\Route;

$exp = 'ability:admin';

Route::group(['middleware'=>$exp.',outer_pages'],function(){
    Route::apiResource('about/us','AboutUsController');

    Route::apiResource('records','RecordsController');

    Route::apiResource('slides','SlidesController');
});

Route::get('contact/us','GetContactUsController');

Route::get('notifications','GetNotificationsController');

Route::get('payments','PaymentsController');

Route::apiResource('students','StudentsController');

Route::apiResource('teachers','TeachersController');

Route::apiResource('transfer/money','TransferMoneyController');

Route::put('showed/contact/{us}','UpdateContactUsToShowedController');