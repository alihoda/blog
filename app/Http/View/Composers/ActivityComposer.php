<?php

namespace App\Http\View\Composers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer
{
    public function compose(View $view)
    {
        $mostCommented = Cache::remember('blog-post-commented', now()->addSeconds(60), function () {
            return BlogPost::mostCommented()->take(5)->get();
        });

        $mostActive = Cache::remember('user-most-active', now()->addSeconds(60), function () {
            return User::mostActiveUser()->take(5)->get();
        });

        $mostActiveLastMonth = Cache::remember('user-most-active-last-month', now()->addSeconds(60), function () {
            return User::mostActiveLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActive', $mostActive);
        $view->with('mostActiveLastMonth', $mostActiveLastMonth);
    }
}
