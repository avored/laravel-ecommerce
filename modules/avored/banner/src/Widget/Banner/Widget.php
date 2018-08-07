<?php

namespace AvoRed\Banner\Widget\Banner;

use AvoRed\Framework\Widget\Contracts\Widget as WidgetContract;
use AvoRed\Banner\Models\Database\Banner;


class Widget implements WidgetContract
{



    /**
     *
     * Widget View Path
     *
     * @var string $view
     */

    protected $view = "avored-banner::widget.index";


    /**
     *
     * Widget Label
     *
     * @var string $view
     */

    protected $label = 'Banner Slider';


    /**
     *
     * Widget Type
     *
     * @var string $view
     */

    protected $type = "cms";

    /**
     *
     * Widget unique identifier
     *
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

        return [];

    }

    public function render() {

        $banners = Banner::whereStatus('ENABLED')->orderBy('sort_order','asc')->get();

        return view($this->view())->with('banners' , $banners);
    }

}