<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/google-callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'email' => $googleUser->email,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'google_id' => $googleUser->id,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);

    Auth::login($user);
    if ($user->can('access_admin')) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('frontend.profile.index', ['edit' => 'true']);
    }
})->name('google-callback');

Route::get('/auth/google-redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google-redirect');

Route::get('/auth/facebook-callback', function () {
    $fbUser = Socialite::driver('facebook')->user();

    $user = User::updateOrCreate([
        'email' => $fbUser->email,
    ], [
        'name' => $fbUser->name,
        'email' => $fbUser->email,
        'facebook_id' => $fbUser->id,
        'facebook_token' => $fbUser->token,
        'facebook_refresh_token' => $fbUser->refreshToken,
    ]);

    Auth::login($user);
    if ($user->can('access_admin')) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('frontend.profile.index', ['edit' => 'true']);
    }
})->name('facebook-callback');

Route::get('/auth/facebook-redirect', function () {
    return Socialite::driver('facebook')->redirect();
})->name('facebook-redirect');
