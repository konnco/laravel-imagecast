<?php

namespace Konnco\ImageCast;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as ImageIntervention;
use Illuminate\Support\Facades\Storage;
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

    public function filters($filters = []){
        $filters = collect($filters)->sort();

        return config('imagecast.cache.identifier')."/".$filters->join(',')."/".$this->path;
    }

    /**
     * This function will helping to serve the resized image
     * from requested url
     */
    public function temporaryResize($filters = []){
        $resize = false;
        $width = null;
        $height = null;

        foreach ($filters as $key => $filter) {
            if(Str::startsWith($filter, 'w_')){
                $resize=true;
                $width = str_replace("w_", "", $filter);
            }

            if(Str::startsWith($filter, 'h_')){
                $resize=true;
                $height = str_replace("h_", "", $filter);
            }
        }

        if($resize){
            $rawImage = Storage::disk($this->disk)->get($this->path);
            $image = ImageIntervention::make($rawImage);

            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $filters = collect($filters);
            $filters = $filters->sort();

            $savePath = config('imagecast.cache.identifier')."/".implode(",", $filters->toArray())."/".$this->path;
            Storage::disk('public')->put(config('imagecast.cache.identifier')."/".implode(",", $filters->toArray())."/".$this->path, $image->__toString());
        }
    }
}
