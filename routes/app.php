<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// App routes
Route::prefix('wp-json/artsthread/v1')->namespace('App\Http\Controllers\Api')->group(function () {
    Route::get('/apps', 'AppController@index')
        ->name('api.app.index');
    Route::get('/app-school-courses', 'SchoolCoursesController@index')
        ->name('api.app.school-courses');
    Route::get('/app-event-courses', 'EventCoursesController@index')
        ->name('api.app.event-courses');
    Route::get('/app-project', 'ProjectController@index')
        ->name('api.app.project');
    Route::get('/app-projects', 'ProjectsController@index')
        ->name('api.app.projects');
    Route::get('/app-signup', 'SignupController@index')
        ->name('api.app.signup');
    Route::get('/app-vote', 'VoteController@index')
        ->name('api.app.vote');
});
