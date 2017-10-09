<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
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
     * @var object
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
            File::makeDirectory($path, '0777', true, true);
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

