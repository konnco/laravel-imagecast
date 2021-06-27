<?php

namespace Konnco\ImageCast;

class Image
{
    public $url;
    public $path;
    public $disk;

    public function __construct($array)
    {
        $array = json_decode($array, true);

        $this->url = config("filesystems.disks.{$array['disk']}.url")."/".$array['path'];
        $this->path = $array['path'];
        $this->disk = $array['disk'];
    }

    /**
     * This function will helping to serve the resized image
     * from requested url
     */
    public function temporaryResize($filters = []){

    }
}
