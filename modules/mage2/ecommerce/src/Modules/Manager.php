<?php

namespace Mage2\Ecommerce\Modules;

use Illuminate\Support\Collection;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\App;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Facades\File;
use League\Flysystem\MountManager;
use Illuminate\Filesystem\Filesystem;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Adapter\Local as LocalAdapter;



class Manager
{
    public $moduleList;

    public $files;

    public $moduleLoaded = false;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->moduleList = Collection::make([]);
    }

    public function all()
    {
        if ($this->moduleLoaded === false) {
            $this->loadModules();
        }

        return $this->moduleList;
    }

    protected function loadModules()
    {
        $modulePath = base_path('modules');

        $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($modulePath, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
        );

        $iterator->setMaxDepth(2);
        $iterator->rewind();

        while ($iterator->valid()) {
            if (($iterator->getDepth() > 1) &&
                $iterator->isFile() &&
                ($iterator->getFilename() == 'register.yaml')) {

                $filePath = $iterator->getPathname();
                $moduleRegisterContent = File::get($filePath);
                $data = Yaml::parse($moduleRegisterContent);

                $namespace = $data['namespace'];

                $composerLoader =  require base_path('vendor/autoload.php');

                $path = $iterator->getPath() . DIRECTORY_SEPARATOR . $data['source'];

                $composerLoader->addPsr4($namespace, $path);

                App::register($data['module']);

                $this->moduleList->put($data['name'],$data);
            }
            $iterator->next();
        }

        $this->moduleLoaded = true;

        return $this;
    }

    public function put($identifier, $moduleInfo)
    {
        $this->moduleList->put($identifier, $moduleInfo);

        return $this;
    }

    public function get($identifier)
    {
        if ($this->moduleLoaded === false) {
            $this->loadModules();
        }

        return $this->moduleList->pull($identifier);
    }

    public function getService() {
        return $this->service;
    }

    public function getByPath($path)
    {
        foreach ($this->moduleList as $module =>  $moduleInfo) {
            $path1 = $this->pathSlashFix($path);
            $path2 = $this->pathSlashFix($moduleInfo['path']);

            if ($path1 == $path2) {
                $actualModule = $this->moduleList[$module];
                break;
            }
        }

        return $actualModule;
    }

    public function publishItem($from, $to)
    {
        if ($this->files->isDirectory($from)) {
            return $this->publishDirectory($from, $to);
        }

        throw new \Exception("Can't locate path: <{$from}>");
    }

    /**
     * Publish the directory to the given directory.
     *
     * @param  string  $from
     * @param  string  $to
     * @return void
     */
    protected function publishDirectory($from, $to)
    {
        $this->moveManagedFiles(new MountManager([
            'from' => new Flysystem(new LocalAdapter($from)),
            'to' => new Flysystem(new LocalAdapter($to)),
        ]));

        //$this->status($from, $to, 'Directory');
    }


    /**
     * Move all the files in the given MountManager.
     *
     * @param  \League\Flysystem\MountManager  $manager
     * @return void
     */
    protected function moveManagedFiles($manager)
    {
        foreach ($manager->listContents('from://', true) as $file) {
            if ($file['type'] === 'file' && (! $manager->has('to://'.$file['path']))) {
                $manager->put('to://'.$file['path'], $manager->read('from://'.$file['path']));
            }
        }
    }


    public function pathSlashFix($path)
    {
        return (DIRECTORY_SEPARATOR === '\\') ? str_replace('/', '\\', $path) : str_replace('\\', '/', $path);
    }
}
