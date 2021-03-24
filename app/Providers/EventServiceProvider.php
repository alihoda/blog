<?php

namespace App\Providers;

use App\Events\BlogPostPosted;
use App\Events\CommentPosted;
use App\Listeners\CacheSubscriber;
use App\Listeners\NotifyAdminBlogPostPosted;
use App\Listeners\NotifyUsersAboutComment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentPosted::class => [
            NotifyUsersAboutComment::class,
        ],
        BlogPostPosted::class => [
            NotifyAdminBlogPostPosted::class,
        ],
    ];

    protected $subscribe = [
        CacheSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
