<?php

namespace AvoRed\Subscribe\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class SubscribeDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_subscribe_controller');

        $dataGrid->model($model)
          ->column('id', ['sortable' => true])
          ->column('name')
          ->column('email')
          ->linkColumn('edit', [], function ($model) {
              return "<a href='".route('admin.subscribe.edit', $model->id)."' >Edit</a>";
          })->linkColumn('show', [], function ($model) {
            return "<a href='".route('admin.subscribe.show', $model->id)."' >Show</a>";
          });

        $this->dataGrid = $dataGrid;
    }
}
