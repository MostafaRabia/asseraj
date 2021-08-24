<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware('throttle:activate')
;

Route::group(['middleware'=>['web']],function(){
    Route::get('index','GetIndexPageController');
    Route::get('teachers','GetTeachersController');

    Route::post('register', 'RegisterController');
    Route::post('register/teacher', 'RegisterTeacherController');
    Route::post('login', 'LoginController');
});

// Route::post('/send/password', 'SendResetPasswordController')->middleware('throttle:reset-password');
// Route::post('/reset/password', 'ResetPasswordController');
// Route::post('/email/resend/verification', 'ResendVerificationController')->middleware('auth:sanctum')->name('verification.send');

Route::post('contact/us','ContactUsController')->middleware('throttle:contact-us');

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('logout', 'LogoutController@logout');
    
    Route::get('profile', 'ShowProfileController');
    Route::put('profile', 'EditProfileController');

    Route::put('end/room/{room}','EndRoomController');

    Route::put('update/last/seen','UpdateLastSeenController');

    Route::get('permissions','GetRolesAndPermissions');

    Route::apiResource('user/contact/us','ContactUsFromUserController');
    Route::post('comment/contact/{us}','CommentToContactUsController');
});