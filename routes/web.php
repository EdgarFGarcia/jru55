<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// events
Route::resource('event', 'Events\EventsHandlerController');

// profiles
Route::resource('profile', 'Users\ProfilesController');

// Survey
Route::resource('survey', 'Surveys\Surveys');
Route::post('surveyadmin', 'Surveys\Surveys@addSurvey');

// votes
Route::resource('votes', 'Vote\Voting');
Route::get('vicepresident', 'Vote\Voting@vice');

Route::resource('votereports', 'Vote\VoteReports');

Route::resource('eventreports', 'Events\EventReports');

Route::resource('surveyreports', 'Surveys\SurveyReports');