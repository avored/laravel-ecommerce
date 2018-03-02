<?php

namespace Mage2\Ecommerce\Widget;

use Illuminate\Support\Collection;

class Manager
{

    /**
     * Collection of Widget
     *
     * @var object \Illuminate\Support\Collection
     */
    protected $collection;


    public function __construct()
    {
        $this->collection = Collection::make([]);
    }

    public function make($name, $widget)
    {

        $this->collection->put($name, $widget);

        return $widget;
    }


    public function get($key)
    {

        return $this->collection->get($key);
    }
}
