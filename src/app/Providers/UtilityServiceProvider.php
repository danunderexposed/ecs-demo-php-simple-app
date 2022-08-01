<?php

namespace App\Providers;

use App\Utilities\Mailchimp;
use App\Utilities\WordpressAPI;
use App\Utilities\LegacyHasherAPI;
use Illuminate\Support\ServiceProvider;

class UtilityServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WordpressAPI::class, function ($app) {
            return new WordpressAPI(
                config('services.wp_api.base_url'),
                config('services.wp_api.user'),
                config('services.wp_api.pass'),
            );
        });

        $this->app->singleton(LegacyHasherAPI::class, function ($app) {
            return new LegacyHasherAPI(
                config('services.legacy_hasher_api.base_url')
            );
        });

        $this->app->singleton(Mailchimp::class, function ($app) {
            return new Mailchimp(config('mailchimp.api_key'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
