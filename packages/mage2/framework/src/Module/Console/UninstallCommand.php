<?php

namespace Mage2\Framework\Module\Console;

use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;
use Mage2\Framework\Database\Console\Migrations\BaseCommand;
use Mage2\Framework\Module\Facades\Module;

class UninstallCommand extends BaseCommand
{

    use ConfirmableTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'mage2:module:uninstall {moduleidentifier}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall the mage2 community Module';


    /**
     * The migrator instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $fileSystem;

    /**
     * The connection resolver instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */

    /**
     * Create a new migration command instance.
     *
     * @param  \Illuminate\Database\Migrations\Migrator $migrator
     * @return void
     */
    public function __construct(Filesystem $fileSystem)
    {
        parent::__construct($fileSystem);


        $this->fileSystem = $fileSystem;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {

        $moduleIdentifier = trim($this->input->getArgument('moduleidentifier'));

        $file = $this->getInstallFilePaths($moduleIdentifier);
        $this->fileSystem->requireOnce($file);

        $schema = $this->resolve($file);

        $schema->uninstall();
    }

    /**
     * Get all of the migration paths.
     *
     * @return array
     */
    protected function getInstallFilePaths($moduleIdentifier)
    {

        $module = Module::get($moduleIdentifier);

        $namespace = $module->getNameSpace();

        $name = str_replace('\\', "", $namespace) . "Schema";

        $file = $module->getPath() . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . $name . ".php";
        return $file;
    }

    /**
     * Resolve a migration instance from a file.
     *
     * @param  string $file
     * @return object
     */
    public function resolve($file)
    {
        $className = str_replace('.php', '', basename($file));

        return new $className;
    }
}
