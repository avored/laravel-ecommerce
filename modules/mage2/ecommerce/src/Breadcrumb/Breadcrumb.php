<?php
namespace Mage2\Ecommerce\Breadcrumb;

use Mage2\Ecommerce\Breadcrumb\Contracts\Breadcrumb as BreadcrumbContracts;

class Breadcrumb implements BreadcrumbContracts
{

    public $label = null;

    public $url = null;


    protected $callable = null;

    public function __construct($callable)
    {
        $this->callback = $callable;

        $callable($this);
    }

    public function label($label = NULL) {
        $this->label = $label;
    }



}