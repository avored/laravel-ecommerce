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
          })->linkColumn('destroy', [], function ($model) {
              return "<form id='admin-subscribe-destroy-".$model->id."'
                                          method='POST'
                                          action='".route('admin.subscribe.destroy', $model->id)."'>
                                      <input name='_method' type='hidden' value='DELETE' />
                                      ".csrf_field()."
                                      <a href='#'
                                          onclick=\"jQuery('#admin-subscribe-destroy-$model->id').submit()\"
                                          >Destroy</a>
                                  </form>";
          });

        $this->dataGrid = $dataGrid;
    }
}
