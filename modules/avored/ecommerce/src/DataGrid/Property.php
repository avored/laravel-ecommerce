<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class Property
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_proerty_controller');

        $dataGrid->model($model)
          ->column('id', ['sortable' => true])
          ->column('name')
          ->column('identifier')
          ->linkColumn('edit', [], function ($model) {
              return "<a href='".route('admin.property.edit', $model->id)."' >Edit</a>";
          })->linkColumn('destroy', [], function ($model) {
              return "<form id='admin-property-destroy-".$model->id."'
                                          method='POST'
                                          action='".route('admin.property.destroy', $model->id)."'>
                                      <input name='_method' type='hidden' value='DELETE' />
                                      ".csrf_field()."
                                      <a href='#'
                                          onclick=\"jQuery('#admin-property-destroy-$model->id').submit()\"
                                          >Destroy</a>
                                  </form>";
          });

        $this->dataGrid = $dataGrid;
    }
}
