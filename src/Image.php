<?php

namespace Konnco\ImageCast;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageIntervention;

class Image
{
    public $url;
    public $path;
    public $disk;
    public $blurhash;

    public function __​toString()
    {
        return $this->url;
    }

    public function __construct($array)
    {
        if (! is_null($array) && ! is_array($array)) {
            $array = json_decode($array, true);

            $this->url = config("filesystems.disks.{$array['disk']}.url")."/".$array['path'];
            $this->path = $array['path'];
            $this->disk = $array['disk'];
            $this->blurhash = @$array['blurhash'] ?? "";
        }
    }

    public function toUrl()
    {
        return $this->url;
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
}
