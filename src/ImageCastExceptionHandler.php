<?php

namespace Konnco\ImageCast;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageCastExceptionHandler
{
    public function __construct($exception, $url, $callback)
    {
        if ($exception instanceof NotFoundHttpException) {
            if (Str::contains($url, config('imagecast.cache.identifier'))) {
                // TODO: will working this next
            }
        }

        return $callback();
    }

    private function extractFilters($url)
    {
        $urlArray = explode('/', $url);
        $filters = explode(',', $urlArray[0]);

        return $filters;
    }

    private function extractFileName($url)
    {
        $urlArray = explode('/', $url);
        array_shift($urlArray);

        return implode("/", $urlArray);
    }

    private function extractFingerprint($url)
    {
        $fingerprint = Storage::disk(config('imagecast.disk'))->get($url.".fingerprint");

        return json_decode($fingerprint, true);
    }
}
