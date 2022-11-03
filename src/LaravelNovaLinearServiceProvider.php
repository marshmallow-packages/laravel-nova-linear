<?php

namespace LaravelNovaLinear;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use LaravelNovaLinear\Commands\LaravelNovaLinearCommand;

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
