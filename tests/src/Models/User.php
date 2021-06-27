<?php

namespace Konnco\ImageCast\Tests\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Konnco\ImageCast\Casts\Image;

class User extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'avatar' => Image::class,
    ];
}
