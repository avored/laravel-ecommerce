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

class LocalFile {


    /**
     * relative path for the image
     *
     * @var null
     */
    public $relativePath = NULL;

    /**
     * url for the image
     *
     * @var null
     */
    public $url = NULL;

    /**
     * Pass Relative path for the file
     *
     * @param null|string $relativePath
     */
    public function __construct($relativePath = NULL) {

        $this->relativePath = $relativePath;
        $this->url = asset($relativePath);

        $sizes = config('image.sizes');

        foreach($sizes as $sizeName => $widthHeight) {
            $objectVarName = $sizeName . "Url";

            $baseName = basename($relativePath);
            $sizeNamePath = str_replace($baseName, $sizeName. "-" .$baseName , $relativePath) ;

            $this->$objectVarName = asset($sizeNamePath);
        }
    }


    /**
     * return Relative path for the image
     *
     * @var void
     * @return \Mage2\Ecommerce\Image\LocalFile
     */
    public function destroy(){

        $sizes = config('image.sizes');

        foreach($sizes as $sizeName => $widthHeight) {
            $baseName = basename($this->relativePath);
            $sizeNamePath = str_replace($baseName, $sizeName. "-" .$baseName , $this->relativePath) ;

            $path = public_path($sizeNamePath);
            File::delete($path);

        }

        $path = public_path($this->relativePath);
        File::delete($path);

        return $this;
    }

    /**
     * return Relative path for the image
     *
     * @return string $relativePath
     */
    public function getRelativePath() {
        return str_replace(asset('/'),'', $this->relativePath);
    }

 }