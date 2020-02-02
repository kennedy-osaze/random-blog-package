<?php

namespace Kennedy\RandomBlogPackage\Models;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'identifier', 'slug', 'title', 'body', 'meta_data'
    ];

    protected $casts = [
        'meta_data' => 'json'
    ];

    public static function getMetaAttributesFromPostArray(array $post)
    {
        $meta = (array) Arr::get($post, 'meta');

        $attributes = Arr::except($post, ['identifier', 'slug', 'title', 'body', 'meta']);

        return array_merge($meta, $attributes);
    }

    public function getMetaDataValue(string $field)
    {
        return Arr::get($this->meta_data, $field);
    }
}
