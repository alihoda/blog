<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class BlogPostTagController extends Controller
{
    public function index($tag)
    {
        $tag = Tag::findOrFail($tag);

        return view('home', ['posts' => $tag->blogPosts]);
    }
}
