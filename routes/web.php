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

Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {

    // browse Calls
    Auth::routes();

    Route::get('/', 'LandingController@welcome')->name('welcome');

    Route::get('/show/{id}', 'ShowController@showDetails')->name('showDetails');

    Route::get('/show/{id}/season/{season}', 'ShowController@seasonDetails')->name('seasonDetails');

    Route::get('/listshows', 'ShowController@listShows')->name('Listing');

    Route::get('/listshows/{page}', 'ShowController@listShows')->name('Listing');

    Route::get('/listepisodes', 'EpisodeController@listEpisodes')->name('Listing');

    Route::get('/listepisodes/{page}', 'EpisodeController@listEpisodes')->name('Listing');

    Route::get('/episode/{id}', 'EpisodeController@episodeDetails')->name('episodeDetails');

    // AJAX Calls
    Route::get('/follow', 'ShowController@follow');

    Route::get('/unfollow', 'ShowController@unFollow');

    Route::get('/rate', 'EpisodeController@rate');

    Route::get('/undorate', 'EpisodeController@undoRate');

    // Search Calls
    Route::match(['get', 'post'], '/search', 'SearchController@search');

    Route::match(['get', 'post'], '/search/{keyword}', 'SearchController@search');

    // Admin Calls
    Route::get('/admin', 'AdminController@admin')->middleware('is_admin')->name('admin');

    Route::get('/admin/users/grid', 'UsersController@grid');
    Route::resource('/admin/users', 'UsersController');

    Route::get('/admin/shows/grid', 'ShowController@grid');
    Route::resource('/admin/shows', 'ShowController');

    Route::get('/admin/episodes/grid', 'episodeController@grid');
    Route::resource('/admin/episodes', 'episodeController');

});