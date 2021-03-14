<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }

    public function contact(){
        return view('contact');
    }

    public function blogPost($id){
        $pages = [
            1 => [
                'title' => 'Hello from page 1',
            ],
            2 => [
                'title' => 'Hello from page 2',
            ],
        ];
        return view('blog-post', ['data' => $pages[$id]]);
    }
}
