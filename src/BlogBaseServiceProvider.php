<?php

namespace Kennedy\RandomBlogPackage;

use Illuminate\Support\ServiceProvider;

class BlogBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerResources();
    }

    public function register()
    {

    }

    protected function registerResources(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
