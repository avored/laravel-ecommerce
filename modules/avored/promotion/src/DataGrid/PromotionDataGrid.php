<?php

namespace AvoRed\Promotion\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;
use AvoRed\Related\Repository\Related;

class PromotionDataGrid
{

    /**
     * Data Grid Manager Object
     *
     *
     * @var \AvoRed\Framework\DataGrid\Manager $dataGrid
     */
    public $dataGrid;

    public function __construct($model)
    {

        $dataGrid       = DataGrid::make('admin_promotion_controllers');


        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->column('name', ['label' => 'Name'])
            ;

        $this->dataGrid = $dataGrid;
    }
}
