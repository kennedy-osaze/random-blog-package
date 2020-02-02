<?php

namespace Kennedy\RandomBlogPackage\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'identifier', 'slug', 'title', 'description', 'body', 'meta_data'
    ];
}
