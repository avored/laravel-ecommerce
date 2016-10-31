<?php

namespace Mage2\System\Theme;

use Illuminate\Support\Collection;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

class ThemeManager
{
    public $themeList;
    public $themeLoaded = false;

    public function __construct()
    {
        $this->themeList = Collection::make([]);
    }

    public function all()
    {
        if ($this->themeLoaded === false) {
            $this->loadThemes();
        }

        return $this->themeList;
    }

    protected function loadThemes()
    {
        $themePath = base_path('themes');


        $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($themePath, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
        );

        $iterator->setMaxDepth(2);
        $iterator->rewind();

        while ($iterator->valid()) {
            if (($iterator->getDepth() > 1) && $iterator->isFile() && ($iterator->getFilename() == 'ThemeInfo.php')) {
                $filePath = $iterator->getPathname();
                $themeInfo = include_once $filePath;
                $this->themeList->put($themeInfo['name'], $themeInfo);
            }
            $iterator->next();
        }

        $this->themeLoaded = true;

        return $this;
    }

    public function put($identifier, $themeInfo)
    {
        $this->themeList->put($identifier, $themeInfo);

        return $this;
    }

    public function get($identifier)
    {
        return $this->themeList->pull($identifier);
    }

    public function getByPath($path)
    {
        foreach ($this->themeList as $theme  =>  $themeInfo) {
            $path1 = $this->pathSlashFix($path);
            $path2 = $this->pathSlashFix($themeInfo['path']);

            if ($path1 == $path2) {
                $actualTheme = $this->themeList[$theme];
                break;
            }
        }

        return $actualTheme;
    }

    public function pathSlashFix($path)
    {
        return (DIRECTORY_SEPARATOR === '\\') ? str_replace('/', '\\', $path) : str_replace('\\', '/', $path);
    }
}
