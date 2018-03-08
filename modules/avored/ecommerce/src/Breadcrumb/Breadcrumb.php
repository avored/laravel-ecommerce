<?php
namespace Mage2\Ecommerce\Breadcrumb;

use Illuminate\Support\Collection;
use Mage2\Ecommerce\Breadcrumb\Contracts\Breadcrumb as BreadcrumbContracts;
use Mage2\Ecommerce\Breadcrumb\Facade as BreadcrumbFacade;

class Breadcrumb implements BreadcrumbContracts
{

    public $label = null;

    public $route = null;

    public $parents = null;


    protected $callable = null;

    public function __construct($callable)
    {
        $this->callback = $callable;
        $this->parents = Collection::make([]);

        $callable($this);
    }

    public function label($label = NULL) {

        if(null === $label) {
            return $this->label;
        }
        $this->label = $label;

        return $this;
    }


    public function route($route = NULL) {

        if(null === $route) {
            return $this->route;
        }
        $this->route = $route;

        return $this;
    }



    public function parent($key) {

        $breadcrumb = BreadcrumbFacade::get($key);

        $this->parents->put($key, $breadcrumb);

        return $this;

    }



}