<?php

namespace Kennedy\RandomBlogPackage;

use Illuminate\Support\Str;

class Blog
{
    public function driver()
    {
        $driver = config('blog.driver', 'file');

        $class = 'Kennedy\RandomBlogPackage\Drivers\\' . Str::studly($driver);

        return new $class();
    }

    // public static function createFileDriver()
    // {
    //     // return new File
    // }
}
