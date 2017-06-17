<?php
namespace Mage2\Framework\Image;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class ImageService extends ImageManager
{

    public $image = NULL;

    public function upload($image, $path = null, $keepAspectRation = true)
    {
        $this->image = parent::make($image);
        $this->directory(public_path($path));

        //$this->setSize($size);
        $name = $image->getClientOriginalName();

        $fullPath = public_path($path) . DIRECTORY_SEPARATOR . $name;
        $this->image->save($fullPath);


        $sizes = config('image.sizes');

        foreach ($sizes as $sizeName => $widthHeight) {

            list($width, $height) = $widthHeight;

            $image = parent::make($fullPath);
            $image->fit($width, $height);

            $sizePath = $image->dirname . DIRECTORY_SEPARATOR . $sizeName . "-" . $image->basename;
            $image->save($sizePath);
        }

        $localImage = new LocalImageFile($path . DIRECTORY_SEPARATOR . $name);

        return $localImage;
    }

    public function directory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, '0777', true);
        }
        return $this;
    }

    public function destroy()
    {
        dd($this);
    }
}

