<?php

namespace Kennedy\RandomBlogPackage;

use Illuminate\Support\Str;

class Blog
{
    protected $fields = [];

    public function driver()
    {
        $driver = config('blog.driver', 'file');

        $class = 'Kennedy\RandomBlogPackage\Drivers\\' . Str::studly($driver);

        return new $class();
    }

    public function addFields(array $fields)
    {
        $this->fields = array_merge($this->fields, $fields);
    }

    public function getFields()
    {
        return array_reverse ($this->fields);
    }
}
