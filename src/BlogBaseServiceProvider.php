<?php

namespace Kennedy\RandomBlogPackage;

use Kennedy\RandomBlogPackage\Blog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Kennedy\RandomBlogPackage\Facades\Blog as FacadeBlog;

class BlogBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }

        $this->registerResources();
    }

    public function register()
    {
        $this->commands([
            Console\ProcessCommand::class,
        ]);
    }

    protected function registerResources(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blog');

        $this->registerFacades();

        $this->registerRoutes();

        $this->registerFields();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/blog.php' => config_path('blog.php'),
        ],  'blog');

        $this->publishes([
            __DIR__ . '/Console/stubs/BlogServiceProvider.stub' => app_path('Providers/BlogServiceProvider.php'),
        ],  'blog-provider');
    }

    public function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('blog.path', 'blogs'),
            'namespace' => 'Kennedy\RandomBlogPackage\Http\Controllers',
        ];
    }

    protected function registerFacades()
    {
        $this->app->singleton('Blog', function ($app) {
            return new Blog();
        });
    }

    protected function registerFields()
    {
        FacadeBlog::addFields([
            Fields\Title::class,
            Fields\Body::class,
            Fields\Description::class,
            Fields\Date::class,
            Fields\Meta::class,
        ]);
    }
}
