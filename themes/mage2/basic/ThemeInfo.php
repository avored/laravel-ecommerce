<?php

namespace Mage2\Themes\Mage2\Basic;


use Illuminate\Support\Facades\View;
use Mage2\Framework\Support\BaseModule;
use Mage2\Framework\Theme\Facades\Theme;

class ThemeInfo extends BaseModule
{
    public function boot()
    {
        $this->publishes([__DIR__.'/assets/' => public_path('vendor/mage2-basic')], 'mage2-basic');
    }

    public function register()
    {
        $this->registerTheme();
        //$this->registerViewPath();
    }

    protected function registerViewPath()
    {
        View::addLocation(__DIR__);
    }

    public function registerTheme()
    {
        $themeInfo = [
            'name'          => 'mage2-basic',
            'description'   => 'Mage2 Basic Theme',
            'path'          => __DIR__,
            'provider'      => self::class,
            'assets_folder' => __DIR__.DIRECTORY_SEPARATOR.'assets',
        ];
        Theme::put('mage2-basic', $themeInfo);
    }
}
