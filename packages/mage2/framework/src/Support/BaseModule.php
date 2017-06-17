<?php

namespace Mage2\Framework\Support;

use Illuminate\Support\ServiceProvider as Container;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;

class BaseModule extends Container
{

    /**
     *
     * Registered basic details of modules
     *
     **/
    public function registerModuleYamlFile($path)
    {

        $yamlFileContent = File::get($path);
        $moduleConfig = Yaml::parse($yamlFileContent);


        $this->setName($moduleConfig['name']);
        $this->setIdentifier($moduleConfig['identifier']);
        $this->setDescription($moduleConfig['description']);
        $this->setEnable($moduleConfig['enable']);
    }


    public function setName($name)
    {
        $this->name = (isset($this->name)) ? $this->name : $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = (isset($this->description)) ? $this->description : $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = (isset($this->identifier)) ? $this->identifier : $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setEnable($enable)
    {
        $this->enable = (isset($this->enable)) ? $this->enable : $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }
}
