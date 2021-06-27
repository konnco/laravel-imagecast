<?php

namespace Konnco\ImageCast\Tests;

use Konnco\ImageCast\ImageCastServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

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
        config()->set('app.url', url(''));

        include_once __DIR__.'/../database/migrations/create_imagecast_table.php.stub';
        (new \CreateImageCast())->up();
    }
}
