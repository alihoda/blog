<?php

namespace App\Listeners;

use App\Events\BlogPostPosted;
use App\Jobs\ThrottledMail;
use App\Mail\BlogPostAdded;
use App\Models\User;

class NotifyAdminBlogPostPosted
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BlogPostPosted  $event
     * @return void
     */
    public function handle(BlogPostPosted $event)
    {
        User::thatIsAdmin()->get()
            ->map(function (User $user) use ($event) {
                ThrottledMail::dispatch(new BlogPostAdded($event->blogPost), $user);
            });
    }
}
