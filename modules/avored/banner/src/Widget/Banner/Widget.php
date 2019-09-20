<?php

namespace AvoRed\Banner\Widget\Banner;

use AvoRed\Framework\Support\Contracts\WidgetInterface;
use AvoRed\Banner\Models\Database\Banner;
use AvoRed\Banner\ViewModels\BannerWidgetViewModel;

class Widget implements WidgetInterface
{
    /**
     * Widget View Path
     * @var string $view
     */

    protected $view = "a-banner::widget.index";

    /**
     * Widget Label
     * @var string $view
     */

    protected $label = 'Banner Slider';

    /**
     * Widget Type
     * @var string $view
     */

    protected $type = "cms";

    /**
     * Widget unique identifier
     * @var string $identifier
     */
    protected $identifier = "avored-banner";

    public function view()
    {
        return $this->view;
    }

    /*
     * Widget unique identifier
     *
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /*
    * Widget unique identifier
    *
    */
    public function label()
    {
        return $this->label;
    }

    /*
    * Widget unique identifier
    *
    */
    public function type()
    {
        return $this->type;
    }

    /**
     * View Required Parameters
     *
     * @return array
     */
    public function with()
    {
        return new BannerWidgetViewModel;
    }

    public function render()
    {
        return view($this->view(), $this->with());
    }
}
