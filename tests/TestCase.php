<?php

namespace Konnco\ImageCast\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Konnco\ImageCast\ImageCastServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ImageCastServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        include_once __DIR__.'/../database/migrations/create_imagecast_table.php.stub';
        (new \CreateImageCast())->up();
    }
}
