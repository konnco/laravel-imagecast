<?php

namespace Konnco\ImageCast\Tests;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Konnco\ImageCast\ImageCastExceptionHandler;
use Konnco\ImageCast\Tests\src\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /** @test */
    public function model_can_return_base64_files()
    {
        Storage::fake(config('imagecast.disk'));

        $user = new User;
        $user->avatar = UploadedFile::fake()->image('photo1.jpg');
        $user->save();

        $user->refresh();

        $this->assertNotNull($user->avatar->toBase64());
    }

    /** @test */
    public function check_imagecast_exceptional_handler()
    {
        Storage::fake(config('imagecast.disk'));

        $user = new User;
        $user->avatar = UploadedFile::fake()->image('photo1.jpg');
        $user->save();

        $user->refresh();

        $url = config('imagecast.cache.identifier')."/h_100,w_100/".$user->avatar->path;

        $exceptional = new ImageCastExceptionHandler(new NotFoundHttpException(), config('app.url')."/".$url, function () {
        });

        Storage::disk('public')->assertExists($url);
    }
}
