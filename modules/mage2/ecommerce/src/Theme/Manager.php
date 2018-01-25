<?php
namespace Mage2\Ecommerce\Theme;

use Illuminate\Support\Collection;
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
    public $themeList;
    public $files;
    public $themeLoaded = false;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
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
            if (($iterator->getDepth() > 1) &&
                $iterator->isFile() &&
                ($iterator->getFilename() == 'register.yaml')) {

                $filePath = $iterator->getPathname();
                $themeRegisterContent = File::get($filePath);
                $assetFolderName = isset($data['asset_folder_name']) ? $data['asset_folder_name'] : "assets";
                $langFolderName = isset($data['lang_folder_name']) ? $data['lang_folder_name'] : "lang";

                $data = Yaml::parse($themeRegisterContent);
                $data['view_path'] = $iterator->getPath() . DIRECTORY_SEPARATOR ."views";
                $data['asset_path'] = $iterator->getPath() . DIRECTORY_SEPARATOR .$assetFolderName;
                $data['lang_path'] = $iterator->getPath() . DIRECTORY_SEPARATOR . $langFolderName;
                $this->themeList->put($data['name'],$data);
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
        if ($this->themeLoaded === false) {
            $this->loadThemes();
        }

        return $this->themeList->pull($identifier);
    }

    public function getService() {
        return $this->service;
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
