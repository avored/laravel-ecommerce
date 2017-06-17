<?php
namespace Mage2\Framework\Module;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;
use RecursiveIteratorIterator;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;
use Symfony\Component\Yaml\Yaml;

class ModuleServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {


        $this->registerModule();
        $this->loadCommunityModule();
        $this->registerCommands();

        $this->app->alias('module', 'Mage2\Framework\Module\ModuleManager');
    }

    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerModule()
    {
        $this->app->singleton('module', function ($app) {
            return new ModuleManager();
        });
    }

    public function registerModuleNameSpace()
    {

        /*
          $this->app->booted(function($app) {
          $modules = ModuleFacade::all($type = "community");
          dd($modules);
          });
         * 
         */
        $mage2Module = config('module');

        foreach ($mage2Module as $namespace => $path) {

            $loader = new ClassLoader();


            $loader->addPsr4($namespace, $path);
            $loader->register();

            //App::register($namespace . 'ModuleInfo');
        }
    }

    protected function loadCommunityModule()
    {
        $modulePath = base_path('modules/community');


        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($modulePath, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
        );

        $iterator->setMaxDepth(2);
        $iterator->rewind();

        while ($iterator->valid()) {
            if (($iterator->getDepth() > 1) && $iterator->isFile() && ($iterator->getFilename() == 'Module.php')) {
                $filePath = $iterator->getPathname();
                $providerDirName = dirname($filePath);

                include_once $filePath;
                $moduleName = basename($providerDirName);
                $companyName = basename(dirname($providerDirName));
                $namespace = $companyName . "\\" . $moduleName . "\\";


                $loader = new ClassLoader();


                $configYamlPath = $providerDirName . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "module.yaml";

                $yamlContent = Yaml::parse(File::get($configYamlPath));

                if (true == $yamlContent['enable']) {


                    $loader->addPsr4($namespace, $providerDirName);
                    $loader->register();


                    $providerClassName = $companyName . "\\" . $moduleName . "\\" . "Module";
                    $this->app->register($providerClassName);

                }


            }
            $iterator->next();
        }

        $this->moduleLoaded = true;

        return $this;
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['module', 'Mage2\Framework\Module\ModuleManager'];
    }

    /**
     * Register all of the migration commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->registerModuleInstallCommand();
        $this->registerModuleUninstallCommand();


        // Once the commands are registered in the application IoC container we will
        // register them with the Artisan start event so that these are available
        // when the Artisan application actually starts up and is getting used.
        $this->commands(
            'command.migrate.make',
            'command.migrate'
        //'command.migrate.install', 'command.migrate.rollback',
        //'command.migrate.reset', 'command.migrate.refresh',
        //'command.migrate.status'
        );
    }


    /**
     * Register the "migrate" migration command.
     *
     * @return void
     */
    protected function registerModuleInstallCommand()
    {
        $this->app->singleton('command.module.install', function ($app) {
            return new InstallCommand();
        });
    }

    /**
     * Register the "rollback" migration command.
     *
     * @return void
     */
    protected function registerModuleUninstallCommand()
    {
        $this->app->singleton('command.module.uninstall', function ($app) {
            return new RollbackCommand($app['migrator']);
        });
    }

}
