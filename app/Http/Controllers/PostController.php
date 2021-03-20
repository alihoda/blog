<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

use App\Models\BlogPost;
use App\Http\Requests\StorePost;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
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

        $post = Cache::tags(['blog-post'])->remember("blog-post-{$id}", now()->addSeconds(60), function () use ($id) {
            return BlogPost::with('comment')->with('tags')->with('user')->findOrFail($id);
        });

        return view('posts.show', ['post' => $post, 'counter' => $this->userCount($id)]);
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

    private function userCount(int $id)
    {
        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $userKey = "blog-post-{$id}-user";

        $users = Cache::tags(['blog-post'])->get($userKey, []);
        $userUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $difference--;
            } else {
                $userUpdate[$session] = $lastVisit;
            }
        }

        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference++;
        }

        $userUpdate[$sessionId] = $now;

        Cache::tags(['blog-post'])->forever($userKey, $userUpdate);
        if (!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }
        return Cache::tags(['blog-post'])->get($counterKey);
    }
}
