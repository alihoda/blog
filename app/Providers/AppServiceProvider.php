<?php

namespace App\Providers;

use App\Contracts\CounterContract;
use App\Http\View\Composers\ActivityComposer;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use App\Observers\BlogPostObserver;
use App\Observers\CommentObserver;
use App\Observers\UserObserver;
use App\Services\Counter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        // Composers
        View::composer('home', ActivityComposer::class);

        // Observers
        BlogPost::observe(BlogPostObserver::class);
        Comment::observe(CommentObserver::class);
        User::observe(UserObserver::class);

        $this->app->singleton(Counter::class, function ($app) {
            return new Counter(
                $app->make('Illuminate\Contracts\Cache\Factory'),
                $app->make('Illuminate\Contracts\Session\Session'),
                env('COUNTER_TIMEOUT', 5)
            );
        });

        $this->app->bind(
            CounterContract::class,
            Counter::class
        );

        JsonResource::withoutWrapping();
    }
}
