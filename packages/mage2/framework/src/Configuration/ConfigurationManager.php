<?php

namespace Mage2\Framework\Configuration;

use Illuminate\Support\Collection;

class ConfigurationManager
{
    protected $adminConfiguration;


    public function __construct()
    {
        $this->adminConfiguration = Collection::make([]);
    }

    public function registerConfiguration($adminConfiguration)
    {
        if (!isset($adminConfiguration['sort_order'])) {
            $adminConfiguration['sort_order'] = 100;
        }
        $this->adminConfiguration->push($adminConfiguration);
    }

    public function All($sorted = true)
    {
        if (true === $sorted) {
            $sorted = $this->adminConfiguration->sortBy('sort_order');
            return $sorted->values()->all();
        }

        return $this->adminConfiguration;
    }
}
