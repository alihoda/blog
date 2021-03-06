<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\Comment;


class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_createPost()
    {
        $user = $this->user();
        $post = BlogPost::factory()->withUser($user->id)->create();

        $response = $this->actingAs($user)->get('/posts');
        $response->assertSeeText($post->title);
        $this->assertDatabaseHas('blog_posts', ['title' => $post->title]);
    }

    public function test_store()
    {
        $params = ['title' => 'valid title', 'description' => 'valid description'];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Post successfully created !!');
    }

    public function test_storeFail()
    {
        $params = ['title' => 'v', 'description' => ''];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['description'][0], 'The description field is required.');
    }

    public function test_update()
    {
        $user = $this->user();
        $post = BlogPost::factory()->withUser($user->id)->create();
        $params = ['title' => 'edited title', 'description' => 'edited desc'];

        $this->actingAs($user)
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Post successfully updated!!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', ['title' => 'edited title']);
    }

    public function test_delete()
    {
        $user = $this->user();
        $post = BlogPost::factory()->withUser($user->id)->create();

        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Post successfully deleted!!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    public function test_comment()
    {
        $user = $this->user();
        $post = BlogPost::factory()->withUser($user->id)->create();
        $comments = Comment::factory()->commentable($post->id)->count(5);
        $response = $this->actingAs($user)->get('/posts');
        $response->assertSeeText('5 comments');
    }
}
