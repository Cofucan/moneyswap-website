<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        //
       /*  Paginator::useBootstrap();

        View::composer('*', function($view)
        {
            $navbars = Navbar::orderBy('ordering')->get();
            $view->with('navbars', $navbars);
        }); */
    }
}
