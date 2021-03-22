<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\BlogPost;
use App\Policies\BlogPostPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        BlogPost::class => BlogPostPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // contact page gate
        Gate::define('home.contact', function ($user) {
            return $user->is_admin;
        });

        Gate::before(function ($user, $ability) {
            // if ($user->is_admin && in_array($ability, ['update', 'delete'])) {
            //     return true;
            // }
        });
    }
}
