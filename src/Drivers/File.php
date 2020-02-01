<?php

namespace Kennedy\RandomBlogPackage\Drivers;

use Kennedy\RandomBlogPackage\BlogFileParser;
use Illuminate\Support\Facades\File as FileSystem;

class File
{
    public function retrievePosts()
    {
        $posts = [];

        foreach (FileSystem::files(config('blog.path')) as $file) {
            $posts[] = (new BlogFileParser($file->getPathname()))->getFileData();
        }

        return $posts;
    }
}
