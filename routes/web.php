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
    return view('homepage');
});

Auth::routes();

Route::get('/login', function(){
	return view('login');
})->name('login');


Route::middleware(['auth'])->prefix('my')->group(function(){
	Route::get('/societies', 'SocietiesController@mine')->name('my.societies');
	Route::get('/societies/new', 'SocietiesController@newForm')->name('my.societies.new');
	Route::post('/societies/new', 'SocietiesController@create');

	Route::get('/tourneys', 'TourneyController@mine')->name('my.tourneys');
	Route::get('/tourneys/new', 'TourneyController@newForm')->name('my.tourneys.new');
	Route::post('/tourneys/new', 'TourneyController@create');
	Route::get('/tourneys/remove/{tourneyId}', 'TourneyController@remove')->name('my.tourneys.remove');
	Route::get('/tourneys/edit/{tourneyId}', 'TourneyController@showEdit')->name('my.tourneys.edit');
	Route::post('/tourneys/edit/{tourneyId}', 'TourneyController@save');

	Route::get('/leaderboards/{tourneyId}', 'LeaderboardController@showForm')->name('my.leaderboard');
	Route::post('/leaderboards/{tourneyId}', 'LeaderboardController@create');
	Route::post('/leaderboards/update/{tourneyId}/{leaderId}', 'LeaderboardController@update');
	Route::get('/leaderboards/remove/{tourneyId}/{leaderId}', 'LeaderboardController@remove')->name('my.leaderboard.remove');
});

Route::get('/404', function(){
	return redirect('/');
});
Route::get('/{societySlug}', 'ViewController@society')->name('society');
Route::get('/{societySlug}/{tourneySlug}', 'ViewController@tourney')->name('tourney');