<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\Comment;


class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_createPost()
    {
        $post = BlogPost::factory()->create();

        $response = $this->get('/posts');
        $response->assertSeeText($post->title);
        $this->assertDatabaseHas('blog_posts', ['title' => $post->title]);
    }

    public function test_store()
    {
        $params = ['title' => 'valid title', 'description' => 'valid description'];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Post successfully created !!');
    }

    public function test_storeFail()
    {
        $params = ['title' => 'v', 'description' => ''];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');
        
        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['description'][0], 'The description field is required.');
    }

    public function test_update()
    {
        $post = BlogPost::factory()->create();

        $params = ['title' => 'edited title', 'description' => 'edited desc'];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Post successfully updated!!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', ['title' => 'edited title']);
    }

    public function test_delete()
    {
        $post = BlogPost::factory()->create();

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');
            $this->assertEquals(session('status'), 'Post successfully deleted!!');
            $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    public function test_comment()
    {
        $post = BlogPost::factory()
            ->has(Comment::factory()->count(5))
            ->create();
        $response = $this->get('/posts');
        $response->assertSeeText('5 comments');
    }
}
