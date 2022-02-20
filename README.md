# The Easier Way to Storing Image in Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/konnco/laravel-imagecast.svg?style=flat-square)](https://packagist.org/packages/konnco/laravel-imagecast)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/konnco/laravel-imagecast/run-tests?label=tests)](https://github.com/konnco/laravel-imagecast/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/konnco/laravel-imagecast/Check%20&%20fix%20styling?label=code%20style)](https://github.com/konnco/laravel-imagecast/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/konnco/laravel-imagecast.svg?style=flat-square)](https://packagist.org/packages/konnco/laravel-imagecast)

This package is designed to simplify our code for managing the laravel image.

## Alpha Version
Attention! This package is still under development, we still looking the best pattern we can apply, and in the way, the development may break your application, we would not recommended you using to use this application on production until this package is fully released.

## Installation

### Laravel Version
| Tags | Laravel Version |
| ---- | --------------- |
| 0.0.7 | Laravel 8      |
| 0.1.0 | Laravel 9      |

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

Easy! just apply the `Image` into the image type attribute, example :

import these file 
```php
use Konnco\ImageCast\Casts\Image;
```

and implement it like this

```php
protected $casts = [
    'avatar' => Image::class,
];
```

Also you can applying custom configuration for each field, example :

```php
protected $casts = [
    'avatar' => Image::class.":80,images/account/avatar,jpg",
    'banner' => Image::class.":80,images/account/avatar,png",
];
```
with parameters `:quality,savePath,extension`. For the `savePath` variable you may want to insert random variable like date as the folder name, you can follow the example

```php
protected $casts = [
    'avatar' => Image::class.":80,images/account/avatar/{date:Y-m-d},jpg",
];
```

After defining all of those configuration you can start uploading the image, example :

```php
$user = New User();
$user->name = $request->name;
$user->avatar = $request->photo;
$user->save();
```

you can fill the avatar fields with all of these supported type :
* string - Path of the image in filesystem.
* string - URL of an image (allow_url_fopen must be enabled).
* string - Binary image data.
* string - Data-URL encoded image data.
* string - Base64 encoded image data.
* resource - PHP resource of type gd. (when using GD driver)
* object - Imagick instance (when using Imagick driver)
* object - Intervention\Image\Image instance
* object - SplFileInfo instance (To handle Laravel file uploads via Symfony\Component\HttpFoundation\File\UploadedFile)

## Url Generator

With the ImageCast Url Generator you can define the image width and height only with the url, if you already get used with cloudinary, you will thank this package.

We should configure the 404 handler for Laravel. Open `App\Exceptions\Handler` and and the code below inside the `render` method.

```php
use Konnco\ImageCast\ImageCastExceptionHandler;

public function render($request, Throwable $exception) {
    return new ImageCastExceptionHandler($exception, request()->url(), function(){
        return parent::render($request, $exception);
    });
}
```

We already added the helpers inside the `ImageCast` and it can be defined like script below :
```html
<img src="{{$user->avatar->width(100)->height(100)->toUrl()}}" alt="Image"/>
```

### Base64
You can also convert your image to base64 image with this method

```php
    return $user->avatar->toBase64();
```

## Idea
We really appreciate your idea and contribution into this package :)


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
