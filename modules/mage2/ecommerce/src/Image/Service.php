<?php
namespace Mage2\Ecommerce\Image;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class Service extends ImageManager
{

    /**
     * Image Service Image
     *
     * @var null
     */
    public $image = NULL;

    /**
     * Upload Image and resize it
     *
     * @var mixed $image
     * @var string $path
     * @var boolean $keepAspectRatio
     *
     * @return \Mage2\Ecommerce\Image\LocalFile
     */
    public function upload($image, $path = null, $keepAspectRatio = true)
    {
        $this->image = parent::make($image);
        $this->directory(public_path($path));

        $name = $image->getClientOriginalName();

        $fullPath = public_path($path) . "/" . $name;
        $this->image->save($fullPath);


        $sizes = config('image.sizes');

        foreach($sizes as $sizeName => $widthHeight) {

            list($width, $height) = $widthHeight;

            $image = parent::make($fullPath);
            $image->fit($width, $height);

            $sizePath = $image->dirname . "/" . $sizeName .  "-" .$image->basename;
            $image->save( $sizePath);
        }

        $localImage = new LocalFile($path . "/" . $name);

        return $localImage;
    }

    /**
     * Create Directories if not exists
     *
     * @var string $path
     * @return \Mage2\Ecommerce\Image\Service
     */
    public function directory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0775, true, true);
        }
        return $this;
    }

    /**
     * @todo destroy the image from path
     *
     *
     * @return \Mage2\Ecommerce\Image\Service
     */
    public function destroy() {
        dd($this);
    }
}

