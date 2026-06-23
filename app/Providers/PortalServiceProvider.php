<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PortalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer(
            '*', // * to bind to all views
            'App\Http\ViewComposers\PortalComposer'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
