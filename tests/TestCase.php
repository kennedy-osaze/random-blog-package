<?php

namespace Kennedy\RandomBlogPackage\Tests;

use Illuminate\Foundation\Application;
use Kennedy\RandomBlogPackage\BlogBaseServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Get Package Providers
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders(Application $app): array
    {
        return [
            BlogBaseServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp(Application $app)
    {
        $app['config']->set('database.default', 'test_database');
        $app['config']->set('database.connections.test_database', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
