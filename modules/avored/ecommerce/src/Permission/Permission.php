<?php
namespace AvoRed\Ecommerce\Permission;

use Illuminate\Support\Facades\Route;
use AvoRed\Ecommerce\Permission\Contracts\Permission as PermissionContracts;

class Permission implements PermissionContracts
{

    /**
     *
     *
     * @var string $label
     */
    protected $label;

    /**
     *
     *
     * @var string $route
     */
    protected $routes;

    /**
     *
     *
     * @var string $key
     */
    protected $key;


    public function label($label = null)
    {
        if (null !== $label) {
            $this->label = $label;
            return $this;
        }

        return $this->label;
    }

    public function key($key = null)
    {
        if (null !== $key) {
            $this->key = $key;
            return $this;
        }

        return $this->key;
    }

    public function routes($routes = null)
    {
        if (null !== $routes) {
            $this->routes = $routes;
            return $this;
        }

        return $this->routes;
    }
}