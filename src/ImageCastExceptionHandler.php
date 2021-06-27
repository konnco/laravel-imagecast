<?php

namespace Konnco\ImageCast;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageCastExceptionHandler
{
    public function __construct($exception, $url , $callback)
    {
        if ($exception instanceof NotFoundHttpException) {
            if (Str::contains($url, config('imagecast.cache.identifier'))) {
                // remove site url with the identifiers
                $url = str_replace(config('app.url')."/".config('imagecast.cache.identifier')."/", "", $url);
                $fileName = $this->extractFileName($url);
                $fingerprint = $this->extractFingerprint($fileName);
                // $filters = $this->extractFilters($url);
                dd(($fingerprint['class'])::where($fingerprint['field'],'like',"%$fileName%")->get());
                dd($model);
        //         $fingerprint = $fileName.".fingerprint";
        //         dd($fingerprint);
            }
        }
    }

    private function extractFilters($url){
        $urlArray = explode('/', $url);
        $filters = explode(',', $urlArray[0]);

        return $filters;
    }

    private function extractFileName($url){
        $urlArray = explode('/', $url);
        array_shift($urlArray);

        return implode("/", $urlArray);
    }

    private function extractFingerprint($url){
        $fingerprint = Storage::disk(config('imagecast.disk'))->get($url.".fingerprint");
        return json_decode($fingerprint, true);
    }
}
