<?php

namespace Kennedy\RandomBlogPackage\Drivers;

abstract class Driver
{
    protected $config = [];

    protected $posts = [];

    abstract public function retrievePosts();

    public function __construct()
    {
        $this->setConfig();

        $this->validateSource();
    }

    protected function setConfig()
    {
        $this->config = config('blog.drivers.' . config('blog.default'));
    }

    protected function validateSource()
    {
        return true;
    }
}
