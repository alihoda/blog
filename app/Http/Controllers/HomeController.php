<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('home', [
            'posts' => BlogPost::latest()->withCount('comment')->get(),
            'mostCommented' => BlogPost::mostCommented()->take(5)->get(),
            'mostActive' => User::mostActiveUser()->take(5)->get(),  
            'mostActiveLastMonth' => User::mostActiveLastMonth()->take(5)->get(),
        ]);
    }

    public function contact()
    {
        return view('contact');
    }
}
