<?php

namespace LaravelNovaLinear;

use LaravelNovaLinear\Commands\LaravelNovaLinearCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelNovaLinearServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-nova-linear')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_nova_linear_table')
            ->hasCommand(LaravelNovaLinearCommand::class);
    }
}
