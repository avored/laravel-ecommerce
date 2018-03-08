<?php
namespace AvoRed\Ecommerce\Tabs;

class Tab
{


    public $type = NULL;

    public $label= NULL;

    public $view= NULL;


    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function setViewpath($view)
    {
        $this->view = $view;
        return $this;
    }

}
