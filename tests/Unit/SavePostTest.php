<?php

namespace Kennedy\RandomBlogPackage\Tests\Unit;

use Kennedy\RandomBlogPackage\Models\Post;
use Kennedy\RandomBlogPackage\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SavePostTest  extends TestCase
{
    use RefreshDatabase;

    public function testPostCanBeCreatedWithTheFactory()
    {
        $post = factory(Post::class)->create();

        $this->assertInstanceOf(Post::class, $post);
        $this->assertCount(1, Post::all());
    }
}
