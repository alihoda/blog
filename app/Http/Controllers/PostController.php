<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\BlogPost;
use App\Http\Requests\StorePost;

class PostController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth')->except(['index', 'show']);
    }
    
    public function index()
    {
        return view('home', [
            'posts' => BlogPost::latest()->withCount('comment')->get(),
            'mostCommented' => BlogPost::mostCommented()->take(5)->get(),    
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePost $request)
    {
        $validateData = $request->validated();
        $validateData['user_id'] = $request->user()->id;
        $blogPost = BlogPost::create($validateData);

        $request->session()->flash('status', 'Post successfully created !!');

        return redirect()->route('posts.show', ['post' => $blogPost->id]);
    }

    public function show($id)
    {
        // One way use scope for relational model
        // return view('posts.show', ['post' => BlogPost::with(['comment' => function ($query) {
        //     return $query->latest();
        // }])->findOrFail($id)]);

        return view('posts.show', ['post' => BlogPost::with('comment')->findOrFail($id)]);
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('update', $post);

        return view('posts.edit', ['post' => $post]);
    }

    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('update', $post);

        $validateData = $request->validated();
        
        $post->fill($validateData);
        $post->save();
        $request->session()->flash('status', 'Post successfully updated!!');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();

        $request->session()->flash('status', 'Post successfully deleted!!');
        return redirect()->route('home');
    }
}
