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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getsurvey', 'api\ApiAuthController@getSurvey');
Route::post('postsurvey', 'api\ApiAuthController@postsurvey');

Route::post('getSurverAnswer', 'api\ApiAuthController@getSurveyAnswer');

Route::post('geteventreports', 'api\ApiAuthController@geteventreports');

Route::post('getsurveyreport', 'api\ApiAuthController@getsurveyreport');

Route::post('getvotingreports', 'api\ApiAuthController@getvotingreports');