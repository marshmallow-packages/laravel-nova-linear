<?php

namespace LaravelNovaLinear;

use LaravelNovaLinear\Commands\GenerateIssueTemplateFiles;
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
            ->hasMigrations([
                'create_nova_linear_table',
                'create_issue_label_column',
            ])
            ->hasCommand(GenerateIssueTemplateFiles::class);
    }
}
