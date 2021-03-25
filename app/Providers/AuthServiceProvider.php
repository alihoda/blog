<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

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
