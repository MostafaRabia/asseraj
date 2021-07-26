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

Route::get('logout', 'LogoutController@logout')->middleware('auth:sanctum');
// Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware('throttle:activate')
;

Route::post('register', 'RegisterController');
Route::post('login', 'LoginController');
// Route::post('/send/password', 'SendResetPasswordController')->middleware('throttle:reset-password');
// Route::post('/reset/password', 'ResetPasswordController');
// Route::post('/email/resend/verification', 'ResendVerificationController')->middleware('auth:sanctum')->name('verification.send');

Route::get('profile', 'ShowProfileController')->middleware('auth:sanctum');
Route::put('profile', 'EditProfileController')->middleware('auth:sanctum');

Route::put('end/room/{room}','EndRoomController');

Route::post('contact/us','ContactUsController')->middleware('throttle:contact-us');

Route::get('index','GetIndexPageController');