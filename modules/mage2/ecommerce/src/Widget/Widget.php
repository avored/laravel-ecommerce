<?php

namespace Mage2\Ecommerce\Widget;

use Illuminate\Support\Collection;
use Mage2\Ecommerce\Widget\Contracts\Widget as WidgetContracts;
use Mage2\Ecommerce\Widget\Facade as WidgetFacade;

class Widget implements WidgetContracts
{

    /**
     * Label For Widget
     *
     * @var string
     */
    public $label = null;

    /**
     * Type For Widget
     *
     * @var string
     */
    public $type = null;


    /**
     * Callback for this Widget
     *
     * @var string
     */
    protected $callable = null;

    public function __construct($callable)
    {
        $this->callback = $callable;

        $callable($this);
    }

    public function label($label = NULL)
    {

        if (null === $label) {
            return $this->label;
        }
        $this->label = $label;

        return $this;
    }

    public function type($type = NULL)
    {

        if (null === $type) {
            return $this->type;
        }
        $this->type = $type;

        return $this;
    }

}