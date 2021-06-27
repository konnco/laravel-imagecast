<?php

namespace Konnco\ImageCast;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Konnco\ImageCast\ImageCast
 */
class ImageCastFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-imagecast';
    }
}
