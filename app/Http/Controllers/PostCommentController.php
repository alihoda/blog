<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUserPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPostedMarkdown;
use App\Models\BlogPost;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comment()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);

        // Mail::to($post->user)->send(new CommentPostedMarkdown($comment));

        ThrottledMail::dispatch(new CommentPostedMarkdown($comment), $post->user);

        NotifyUserPostWasCommented::dispatch($comment);


        return redirect()->back()->withStatus('Comment added successfully!');
    }
}
