<?php

namespace Kennedy\RandomBlogPackage\Console;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Kennedy\RandomBlogPackage\Blog;
use Kennedy\RandomBlogPackage\Models\Post;
use Kennedy\RandomBlogPackage\BlogFileParser;

class ProcessCommand extends Command
{
    protected $signature = 'blog:process';

    protected $description = 'Update blog posts';

    public function handle()
    {
        if (is_null(config('blog'))) {
            return $this->warn(
                "Please publish the config file by running: 'php artisan vendor:publish --tag=blog'"
            );
        }

        $posts = Blog::driver()->retrievePosts();

        foreach ($posts as $post) {
            DB::transaction(function () use ($post) {
                try {
                    Post::create([
                        'identifier' => Str::random(),
                        'slug' => Str::slug($post['title']),
                        'title' => ucfirst($post['title']),
                        'body' => ucfirst($post['body']),
                        'meta_data' => $post['meta'] ?? '',
                    ]);

                    $this->info("The blog post titled: '{$post['title']}' has been added.");
                } catch (Exception $e) {
                    $this->error('An error occurred processing the blog posts: '. $e->getMessage());
                }
            });
        }
    }
}