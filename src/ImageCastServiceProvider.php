<?php

namespace Konnco\ImageCast;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Konnco\ImageCast\Commands\ImageCastCommand;

class ImageCastServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-imagecast')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-imagecast_table')
            ->hasCommand(ImageCastCommand::class);
    }
}
