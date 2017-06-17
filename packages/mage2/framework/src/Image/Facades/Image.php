<?php

namespace Mage2\Framework\Image\Facades;

use Illuminate\Support\Facades\Facade;

class Image extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Mage2\Framework\Image\ImageService';
    }
}
