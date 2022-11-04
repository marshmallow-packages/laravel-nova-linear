# Create Linear issues from Laraval Nova

This package will let you create issues in Linear via a Nova Resource. It also supports attachments!

## Installation

You can install the package via composer:

```bash
composer require marshmallow/laravel-nova-linear
```

### Install Linear for Laravel

This package is working with the `Linear for Laravel` package. If you haven't done so already, make sure you follow the installation steps of that package. You can read the docs [here](https://github.com/marshmallow-packages/laravel-linear).

### Install Spatie Media Library

This package also uses the Media Library package from Spatie in the background. If you don't use this package in your application yet, you will need to run there migrations aswell. If you already use this package, you can skip this step.

```bash
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
```

### Run the migrations

Next you need to publish the migrations for this package and run them all. You can do so by running the commands below.

```bash
php artisan vendor:publish --tag="nova-linear-migrations"
php artisan migrate
```

### Create a Nova Resource

You will need to create a Nova Resource for creating the issues in Nova. This Nova Resource will extend the Nova Resource in this package so this is a really simple file. This file should be located at `app/Nova/LinearIssue.php`. Paste the content displayed below in this new file.

```php
// app/Nova/LinearIssue.php

namespace App\Nova;

use LaravelNovaLinear\Nova\LinearIssue as MarshmallowLinearIssue;

class LinearIssue extends MarshmallowLinearIssue
{
    // Yes, this is everything we need.
}

```

### Add it to your Nova Menu

The only thing that is left is you need to add the resource to your menu. You can do this in many ways but we have added an example below.

```php

// app/Providers/NovaServiceProvider.php

public function boot()
{
    parent::boot();

    Nova::mainMenu(function (Request $request) {
        return [
            // ...
            MenuSection::make(__('Issues'))->icon('fire')->path('/resources/linear-issues')
        ];
    });
}
```

### Generate template files

If you are working with labels, you have the options to generate template files for every label. This will help you getting complete information for every issue that is created. You can generate these files with the following command.

```bash
php artisan linear:generate-issue-templates
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Stef van Esch](https://github.com/stefvanesch)
-   [Lars Kort](https://github.com/LTKort)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
