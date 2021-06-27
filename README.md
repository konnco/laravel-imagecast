# The Easier Way to Storing Image in Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/konnco/laravel-imagecast.svg?style=flat-square)](https://packagist.org/packages/konnco/laravel-imagecast)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/konnco/laravel-imagecast/run-tests?label=tests)](https://github.com/konnco/laravel-imagecast/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/konnco/laravel-imagecast/Check%20&%20fix%20styling?label=code%20style)](https://github.com/konnco/laravel-imagecast/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/konnco/laravel-imagecast.svg?style=flat-square)](https://packagist.org/packages/konnco/laravel-imagecast)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require konnco/laravel-imagecast
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Konnco\ImageCast\ImageCastServiceProvider" --tag="laravel-imagecast-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Konnco\ImageCast\ImageCastServiceProvider" --tag="laravel-imagecast-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravel-imagecast = new Konnco\ImageCast();
echo $laravel-imagecast->echoPhrase('Hello, Spatie!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Franky So](https://github.com/konnco)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
