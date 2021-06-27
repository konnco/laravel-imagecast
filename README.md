# The Easier Way to Storing Image in Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/konnco/laravel-imagecast.svg?style=flat-square)](https://packagist.org/packages/konnco/laravel-imagecast)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/konnco/laravel-imagecast/run-tests?label=tests)](https://github.com/konnco/laravel-imagecast/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/konnco/laravel-imagecast/Check%20&%20fix%20styling?label=code%20style)](https://github.com/konnco/laravel-imagecast/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/konnco/laravel-imagecast.svg?style=flat-square)](https://packagist.org/packages/konnco/laravel-imagecast)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Atention!
this package is still under beta testing, do don't use it in your production.

## Installation

You can install the package via composer:

```bash
composer require konnco/laravel-imagecast
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Konnco\ImageCast\ImageCastServiceProvider" --tag="laravel-imagecast-config"
```

This is the contents of the published config file:

```php
return [
    'disk' => env('IMAGECAST_DISK', 'public'),
    'path' => 'images',
    'blurhash' => env('IMAGECAST_BLURHASH', false)
];
```

## Usage

Just casting the `Image` class into image field attribute

```php
protected $casts = [
    'avatar' => Image::class,
];
```

or you can specify quality, save extension and path for each fields with format 
`:quality,savePath,extension`

as an example :

```php
protected $casts = [
    'avatar' => Image::class.":80,images/account/avatar,jpg",
    'banner' => Image::class.":80,images/account/avatar,png",
];
```

and after that you can just upload the image / or attaching the file into the attributes.

```php
$user = New User();
$user->name = $request->name;
$user->avatar = $request->photo;
$user->save();
```

## Custom Size Image
In here we have added custom sized image which you can modify through the url,

first you have to modify file `App\Exceptions\Handler` and add this code inside `render` method.

```php
use Konnco\ImageCast\ImageCastExceptionHandler;

public function render($request, Throwable $exception) {
    return new ImageCastExceptionHandler($exception, request()->url(), function(){
        return parent::render($request, $exception);
    });
}
```

after that try to embed this script inside your blade;
```html
<img src="{{$user->avatar->filters(['w_100','h_100'])}}" alt="Image"/>
```

the `w_100` means we need to resize this image into 100px and `h_100` to set height as 100%.


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
