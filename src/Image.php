<?php

namespace Konnco\ImageCast;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as ImageIntervention;

class Image
{
    public $url;
    public $path;
    public $disk;

    private $filters = [];

    public function __​toString()
    {
        return $this->url;
    }

    public function __construct($array)
    {
        if (! is_null($array)) {
            $array = json_decode($array, true);

            $this->url = config("filesystems.disks.{$array['disk']}.url")."/".$array['path'];
            $this->path = $array['path'];
            $this->disk = $array['disk'];
        }
    }

    public function width($width = "")
    {
    }

    public function height($height = "")
    {
    }

    public function toUrl()
    {
        $filters = collect($this->filters)->sort();

        return config('imagecast.cache.identifier')."/".$filters->join(',')."/".$this->path;
    }

    /**
     * Convert image into base64
     */
    public function toBase64()
    {
        $rawImage = Storage::disk($this->disk)->get($this->path);
        $image = ImageIntervention::make($rawImage);

        return (string) $image->encode('data-url');
    }

    /**
     * This function will helping to serve the resized image
     * from requested url
     */
    public function temporaryResize($filters = [])
    {
        $resize = false;
        $width = null;
        $height = null;

        foreach ($filters as $key => $filter) {
            if (Str::startsWith($filter, 'w_')) {
                $resize = true;
                $width = str_replace("w_", "", $filter);
            }

            if (Str::startsWith($filter, 'h_')) {
                $resize = true;
                $height = str_replace("h_", "", $filter);
            }
        }

        if ($resize) {
            $rawImage = Storage::disk($this->disk)->get($this->path);
            $image = ImageIntervention::make($rawImage);

            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $filters = collect($filters);
            $filters = $filters->sort();

            $savePath = config('imagecast.cache.identifier')."/".implode(",", $filters->toArray())."/".$this->path;
            Storage::disk('public')->put($savePath, $image->__toString());
        }
    }
}
