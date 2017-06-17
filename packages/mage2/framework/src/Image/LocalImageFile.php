<?php

namespace Mage2\Framework\Image;

use Illuminate\Support\Facades\File;

class LocalImageFile
{


    public $relativePath = NULL;

    public $url = NULL;

    public function __construct($relativePath = NULL)
    {

        $this->relativePath = $relativePath;
        $this->url = asset($relativePath);

        $sizes = config('image.sizes');

        foreach ($sizes as $sizeName => $widthHeight) {
            $objectVarName = $sizeName . "Url";

            $baseName = basename($relativePath);
            $sizeNamePath = str_replace($baseName, $sizeName . "-" . $baseName, $relativePath);

            $this->$objectVarName = asset($sizeNamePath);
        }

    }


    public function destroy()
    {

        $sizes = config('image.sizes');

        foreach ($sizes as $sizeName => $widthHeight) {
            $baseName = basename($this->relativePath);
            $sizeNamePath = str_replace($baseName, $sizeName . "-" . $baseName, $this->relativePath);

            $path = public_path($sizeNamePath);
            File::delete($path);

        }

        $path = public_path($this->relativePath);
        File::delete($path);

        return $this;
    }

}