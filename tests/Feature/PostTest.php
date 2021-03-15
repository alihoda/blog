<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\BlogPost;


class PostTest extends TestCase
{
    use RefreshDatabase;

    private function createDummyPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = "test title";
        $post->description = "test desc";
        $post->save();

        return $post;
    }

    public function test_createPost()
    {
        $post = $this->createDummyPost();

        $response = $this->get('/posts');
        $response->assertSeeText('test title');
        $this->assertDatabaseHas('blog_posts', ['title' => 'test title']);
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
        $post = $this->createDummyPost();

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
        $post = $this->createDummyPost();

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');
            $this->assertEquals(session('status'), 'Post successfully deleted!!');
            $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }
}
