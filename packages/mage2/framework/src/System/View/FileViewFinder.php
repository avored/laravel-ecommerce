<?php

namespace Mage2\Framework\System\View;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\FileViewFinder as LaravelFileViewFinder;

class FileViewFinder extends LaravelFileViewFinder
{
    public function __construct(Filesystem $files, array $paths, array $extensions = null)
    {
        parent::__construct($files, $paths, $extensions);
    }

    protected function findInPaths($name, $paths)
    {
        $paths = array_reverse($paths);

        foreach ((array)$paths as $path) {
            //var_dump($path);
            foreach ($this->getPossibleViewFiles($name) as $file) {
                if ($this->files->exists($viewPath = $path . '/' . $file)) {
                    return $viewPath;
                }
            }
        }


        throw new InvalidArgumentException("View [$name] not found.");
    }
}
