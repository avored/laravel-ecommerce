<?php
namespace Mage2\Themes\Mage2\Basic;

use Mage2\Framework\Theme\Theme;

class ThemeInfo  extends  Theme {

    public function getName() {
        return "mage2-default";
    }
    public function getDescription() {
        return "Mage2 Ecommerce Default Theme";
    }

    public function getPath() {
        return __DIR__;
    }
}