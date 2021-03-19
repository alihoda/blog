<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\BlogPost;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Add cache
        $mostCommented = Cache::remember('blog-post-commented', now()->addSeconds(60), function () {
            return BlogPost::mostCommented()->take(5)->get();
        });

        $mostActive = Cache::remember('user-most-active', now()->addSeconds(60), function () {
            return User::mostActiveUser()->take(5)->get();
        });

        $mostActiveLastMonth = Cache::remember('user-most-active-last-month', now()->addSeconds(60), function () {
            return User::mostActiveLastMonth()->take(5)->get();
        });

        return view('home', [
            'posts' => BlogPost::latest()->withCount('comment')->with('user')->get(),
            'mostCommented' => $mostCommented,
            'mostActive' => $mostActive,  
            'mostActiveLastMonth' => $mostActiveLastMonth,
        ]);
    }

    public function contact()
    {
        return view('contact');
    }
}
