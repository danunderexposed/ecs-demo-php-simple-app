<?php


namespace App\Providers;

//require base_path() . '/password.php';

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Utilities\LegacyHasherAPI;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // register new LoginResponse to redirect differently for frontend
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if (!$user) return false;
            if (!$user->legacy_password){
                if ($user &&
                    Hash::check($request->password, $user->password)) {
                    return $user;
                }
            } else {
                $legacyHashUtil = app()->make(LegacyHasherAPI::class);
                $legacyHash = $legacyHashUtil->getHash($request->password, $user->legacy_salt);

                if ($legacyHash == $user->legacy_password){

                    // update DB to replace old password with new
                    $user->password = Hash::make($request->password);
                    $user->legacy_password = null;
                    $user->save();

                    return $user;
                }
            }
        });
    }

}
