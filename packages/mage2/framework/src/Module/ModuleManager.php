<?php

namespace Mage2\Framework\Module;

use Illuminate\Support\Collection;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

class ModuleManager
{

    /**
     *
     * @var \Illuminate\Support\Collection $systemModuleList
     */
    public $systemModuleList;

    /**
     *
     * @var \Illuminate\Support\Collection $systemModuleList
     */
    public $communityModuleList;

    public $moduleLoaded = false;

    public function __construct()
    {

        $this->systemModuleList = Collection::make([]);

        $this->communityModuleList = Collection::make([]);
    }

    public function all($type = null)
    {
        if ($type == "system") {
            return $this->systemModuleList;
        }
        if ($type == "community") {
            return $this->communityModuleList;
        }
        if ($type == null) {
            $allModules = $this->systemModuleList->merge($this->communityModuleList);
        }
        return $allModules;
    }

    protected function loadModule()
    {
        $modulePath = base_path('modules');


        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($modulePath, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
        );

        $iterator->setMaxDepth(2);
        $iterator->rewind();

        while ($iterator->valid()) {
            if (($iterator->getDepth() > 1) && $iterator->isFile() && ($iterator->getFilename() == 'Module.php')) {
                $filePath = $iterator->getPathname();
                $moduleInfo = include_once $filePath;
                $this->moduleList->put($moduleInfo['name'], $moduleInfo);
            }
            $iterator->next();
        }

        $this->moduleLoaded = true;

        return $this;
    }

    public function put($identifier, $moduleContainer, $type = 'community')
    {
        if ($type == 'community') {
            $this->communityModuleList->put($identifier, $moduleContainer);
            return $this;
        }
        if ($type == 'system') {
            $this->systemModuleList->put($identifier, $moduleContainer);
            return $this;
        }
        return false;
    }

    public function get($identifier)
    {

        if ($this->systemModuleList->has($identifier)) {
            return $this->systemModuleList->get($identifier);
        }
        if ($this->communityModuleList->has($identifier)) {
            return $this->communityModuleList->get($identifier);
        }
    }

    public function systemAll()
    {
        return $this->systemModuleList;
    }

    public function communityAll()
    {
        return $this->communityModuleList;
    }

    public function getByPath($path)
    {
        foreach ($this->moduleList as $module => $moduleInfo) {
            $path1 = $this->pathSlashFix($path);
            $path2 = $this->pathSlashFix($moduleInfo['path']);

            if ($path1 == $path2) {
                $actualModule = $this->moduleList[$module];
                break;
            }
        }

        return $actualModule;
    }

    public function pathSlashFix($path)
    {
        return (DIRECTORY_SEPARATOR === '\\') ? str_replace('/', '\\', $path) : str_replace('\\', '/', $path);
    }

}
