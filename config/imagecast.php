<?php
// config for Konnco/ClassName
return [
    /*
    |--------------------------------------------------------------------------
    | Filesystem disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */
    'disk' => env('IMAGECAST_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Save Path
    |--------------------------------------------------------------------------
    |
    | When you don't specify save path inside your model, this value will be used
    | as the default path for your image application.
    |
    */
    'path' => 'images',

    /*
    |--------------------------------------------------------------------------
    | Blur Hash Support
    |--------------------------------------------------------------------------
    |
    | This configuration determine the blurhash is enabled or not,
    | you can see how it used in https://github.com/woltapp/blurhash
    |
    */
    'blurhash' => env('IMAGECAST_BLURHASH', true),

    /*
    |--------------------------------------------------------------------------
    | Cache Support
    |--------------------------------------------------------------------------
    |
    | This configuration make sure you only load the specific image and resize it
    |
    */
    'cache' => [
        /**
         * If the url containes this identifier mean the image should be resized
         */
        'identifier' => env('IMAGECAST_CACHE_IDENTIFIER', 'caches/assets')
    ]
];
