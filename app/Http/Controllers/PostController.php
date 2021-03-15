<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Http\Requests\StorePost;

class PostController extends Controller
{
    
    public function index()
    {
        return view('posts.index', ['posts' => BlogPost::withCount('comment')->get()]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePost $request)
    {
        $validateData = $request->validated();

        $blogPost = BlogPost::create($validateData);

        $request->session()->flash('status', 'Post successfully created !!');

        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    public function show($id)
    {
        return view('posts.show', ['post' => BlogPost::with('comment')->findOrFail($id)]);
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validateData = $request->validated();
        
        $post->fill($validateData);
        $post->save();
        $request->session()->flash('status', 'Post successfully updated!!');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        $request->session()->flash('status', 'Post successfully deleted!!');
        return redirect()->route('posts.index');
    }
}
