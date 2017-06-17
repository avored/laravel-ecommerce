<?php

namespace Mage2\Framework\Console;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Console\Command;
use Illuminate\Console\OutputStyle;

abstract class GeneratorCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type;

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    abstract protected function getStub();

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function fire()
    {
        $moduleName = $this->parseName($this->getModuleNameInput());
        $name = $this->parseName($this->getNameInput());

        $path = $this->getPath($moduleName, $name);

        if ($this->alreadyExists($this->getModuleNameInput(), $this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        switch ($this->type) {
            case "Controller":
                $replaceName = $moduleName . "\\Controllers\\" . $name;
                break;

            case "Model":
                $replaceName = $moduleName . "\\Models\\" . $name;
                break;

            case "Request":
                $replaceName = $moduleName . "\\Requests\\" . $name;
                break;

            case "Policy":
                $replaceName = $moduleName . "\\Policies\\" . $name;
                break;

            default :
                $replaceName = $moduleName . $name;
                break;
        }
        $this->files->put($path, $this->buildClass($replaceName));

        $this->info($this->type . ' created successfully.');
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string $rawName
     * @return bool
     */
    protected function alreadyExists($moduleName, $rawName)
    {

        $moduleName = $this->parseName($moduleName);
        $name = $this->parseName($rawName);

        return $this->files->exists($this->getPath($moduleName, $name));
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($moduleName, $name)
    {
        switch ($this->type) {
            case "Controller":
                $path = $moduleName . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . $name;
                break;

            case "Model":
                $path = $moduleName . DIRECTORY_SEPARATOR . "Models" . DIRECTORY_SEPARATOR . $name;
                break;

            case "Request":
                $path = $moduleName . DIRECTORY_SEPARATOR . "Requests" . DIRECTORY_SEPARATOR . $name;
                break;

            case "Policy":
                $path = $moduleName . DIRECTORY_SEPARATOR . "Policies" . DIRECTORY_SEPARATOR . $name;
                break;

            default :
                $path = $moduleName . DIRECTORY_SEPARATOR . $name;
                break;
        }

        return $this->laravel['path.module'] . '/' . str_replace('\\', '/', $path) . '.php';
    }

    /**
     * Parse the name and format according to the root namespace.
     *
     * @param  string $name
     * @return string
     */
    protected function parseName($name)
    {

        if (Str::contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }

        return $name;
    }


    /**
     * Build the directory for the class if necessary.
     *
     * @param  string $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            'DummyNamespace', $this->getNamespace($name), $stub
        );

        $stub = str_replace(
            'DummyRootNamespace', $this->laravel->getNamespace(), $stub
        );

        return $this;
    }

    /**
     * Get the full namespace name for a given class.
     *
     * @param  string $name
     * @return string
     */
    protected function getNamespace($name)
    {
        return trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        return str_replace('DummyClass', $class, $stub);
    }

    /**
     * Get the module from the input.
     *
     * @return string
     */
    protected function getModuleNameInput()
    {
        return trim($this->argument('modulename'));
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['modulename', InputArgument::REQUIRED, 'The module name of the app'],
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
}
