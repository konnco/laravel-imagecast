<?php

namespace Konnco\ImageCast\Tests;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Konnco\ImageCast\Tests\src\Models\User;

class ModelCastTest extends TestCase
{
    /** @test */
    public function model_can_save_image_image_path()
    {
        Storage::fake('local');

        $user = new User;
        $user->avatar = UploadedFile::fake()->image('photo1.jpg');
        $user->save();

        Storage::disk('photos')->assertExists($user->avatar);
    }
}
