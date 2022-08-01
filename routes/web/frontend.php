<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::namespace('App\Http\Controllers\Frontend')->group(function () {
    Route::get('/', 'IndexController@index')
        ->name('frontend.index');

    Route::get('/profile', 'ProfileController@index')
        ->name('frontend.profile.index');
    Route::put('/profile', 'ProfileController@update')
        ->name('frontend.profile.update');
    Route::get('/profile/{slug}', 'ProfileController@show')
        ->name('frontend.profile.show');
    Route::post('/profile/saveproject/{id}', 'ProfileController@saveProject')
        ->name('frontend.profile.saveproject');
    Route::post('/profile/addproject', 'ProfileController@addProject')
        ->name('frontend.profile.addproject');
    Route::get('/profile/removeproject/{id}', 'ProfileController@removeProject')
        ->name('frontend.profile.removeproject');
    Route::post('/profile/sendmessage/{id}', 'ProfileController@sendMessage')
        ->name('frontend.profile.sendmessage');
    Route::post('/profile/updatepassword', 'ProfileController@updatePassword')
        ->name('frontend.profile.updatepassword');
    Route::get('/profile/logout', 'ProfileController@logout')
        ->name('frontend.profile.logout');
    Route::get('/register', 'RegisterController@showRegistrationForm')
        ->name('frontend.register');
    Route::post('/register-submit', 'RegisterController@register')
        ->name('frontend.register-submit');
    Route::get('/forgot-password', 'RegisterController@forgotPassword')
        ->name('frontend.forgot-password');
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);

    })->middleware('guest')->name('frontend.forgot-password-submit');

    Route::get('/portfolios', 'PortfolioController@index')
        ->name('frontend.portfolio.index');
    Route::get('/portfolios/{slug}', 'PortfolioController@show')
        ->name('frontend.portfolio.show');

    Route::get('/schools', 'SchoolController@index')
        ->name('frontend.school.index');
    Route::get('/schools/{slug}', 'SchoolController@show')
        ->name('frontend.school.show');

    Route::get('/competitions', 'CompetitionController@index')
        ->name('frontend.competition.index');
    Route::get('/competitions/{slug}', 'CompetitionController@show')
        ->name('frontend.competition.show');

    Route::get('/events/globaldesigngraduateshow/', 'PageController@gdgs')
    ->name('frontend.event.gdgs');

    Route::get('/events', 'EventController@index')
        ->name('frontend.event.index');
    Route::get('/events/{slug}', 'EventController@show')
        ->name('frontend.event.show');

    Route::get('/{slug}', 'PageController@show')
        ->name('frontend.page.show');


});
