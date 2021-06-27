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
        Storage::fake(config('imagecast.disk'));

        $user = new User;
        $user->avatar = UploadedFile::fake()->image('photo1.jpg');
        $user->save();

        $user->refresh();

        Storage::disk(config('imagecast.disk'))->assertExists($user->avatar->path);
    }
}
