<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Kennedy\RandomBlogPackage\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'identifier' => Str::random(),
        'slug' => Str::slug($title),
        'title' => $title,
        'body' => $faker->paragraph,
        'meta_data' => json_encode(['key' => 'value']),
    ];
});