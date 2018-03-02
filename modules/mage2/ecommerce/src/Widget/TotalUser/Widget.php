<?php

namespace Mage2\Ecommerce\Widget\TotalUser;

use Mage2\Ecommerce\Models\Database\User;
use Mage2\Ecommerce\Widget\Contracts\Widget as WidgetContract;

class Widget implements WidgetContract
{

    /**
     *
     * Widget View Path
     *
     * @var string $view
     */

    protected $view = "mage2-ecommerce::widget.total-user";


    /**
     *
     * Widget Label
     *
     * @var string $view
     */

    protected $label = 'Total User';


    /**
     *
     * Widget Type
     *
     * @var string $view
     */

    protected $type = "dashboard";

    /**
     *
     * Widget unique identifier
     *
     * @var string $identifier
     */
    protected $identifier = "total-user";


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

        $totalUser = User::all()->count();
        return ['totalRegisteredUser' => $totalUser];
    }

}