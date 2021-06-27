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
    'blurhash' => env('IMAGECAST_BLURHASH', false)
];
