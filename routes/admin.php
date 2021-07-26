<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('about/us','AboutUsController');

Route::get('contact/us','GetContactUsController');

Route::get('notifications','GetNotificationsController');

Route::get('payments','PaymentsController');

Route::apiResource('records','RecordsController');

Route::apiResource('slides','SlidesController');

Route::apiResource('students','StudentsController');

Route::apiResource('teachers','TeachersController');

Route::apiResource('transfer/money','TransferMoneyController');

Route::put('showed/contact/{us}','UpdateContactUsToShowedController');