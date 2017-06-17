<?php

namespace Mage2\Framework\Foundation\Console;

use Mage2\Framework\Console\GeneratorCommand;

class RequestMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'mage2:createrequest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new form request class for given module name';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/request.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->getModuleNameInput() . '\Requests';
    }
}
