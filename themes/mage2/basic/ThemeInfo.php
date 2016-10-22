<?php
namespace Mage2\Themes\Mage2\Basic;

use Mage2\Framework\Theme\Theme;
use Illuminate\Support\Facades\View;

class ThemeInfo  extends  Theme {


    public function register() {
        $this->registerViewPath();
    }

    
    public function getName() {
        return "mage2-default";
    }
    public function getDescription() {
        return "Mage2 Ecommerce Default Theme";
    }

    protected function registerViewPath() {
        View::addLocation(__DIR__);
    }

    public function getPath() {
        return __DIR__;
    }
}