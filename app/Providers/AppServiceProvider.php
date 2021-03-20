<?php

namespace App\Providers;

use App\Http\View\Composers\ActivityComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

// use App\View\Components\Card;

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
        // Blade::component('card', Card::class);
        // Composers
        View::composer('home', ActivityComposer::class);
    }
}
