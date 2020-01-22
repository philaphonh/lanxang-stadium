<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('stadiuminfo', 'ReservationController@stadiumInfo');

Route::get('timeinfo', 'ReservationController@timeInfo');

Route::get('admininfo', 'AdminController@admininfo');

Route::get('contactinfo', 'ContactController@contactinfo');

Route::get('reservationinfo', 'ReservationController@reservationInfo');

Route::get('reservationinfobydate', 'ReservationController@reservationInfoByDate');

Route::get('reservationinfobydateandstadium', 'ReservationController@reservationInfoByDateAndStadium');

Route::post('login', 'AdminController@login');

Route::post('reserve', 'ReservationController@reserve');

Route::post('send', 'ContactController@send');

Route::put('checkin/{id}', 'ReservationController@checkin');

Route::delete('deletereservation/{id}', 'ReservationController@deleteReservation');
