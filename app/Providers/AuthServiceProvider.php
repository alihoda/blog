<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\BlogPost;
use App\Policies\BlogPostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        BlogPost::class => BlogPostPolicy::class,
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

        // Gate::define('update-post', function (User $user, BlogPost $post) {
        //     return $post->user_id === $user->id;
        // });
    
        // Gate::define('delete-post', function (User $user, BlogPost $post) {
        //     return $post->user_id === $user->id;
        // });

        // Gate::resource('posts', BlogPostPolicy::class);
        // posts.create, posts.view, posts.update, posts.delete

        Gate::before(function ($user, $ability) {
            if ($user->is_admin && in_array($ability, ['update', 'delete'])) {
                return true;
            }
        });

        // Gate::after(function ($user, $ability, $result){
        //     //
        // });
    }
}
