<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class Role
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_role_controller');

        $dataGrid->model($model)
              ->column('id', ['sortable' => true])
              ->column('name')
              ->linkColumn('edit', [], function ($model) {
                  return "<a href='".route('admin.role.edit', $model->id)."' >Edit</a>";
              })->linkColumn('destroy', [], function ($model) {
                  return "<form id='admin-role-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.role.destroy', $model->id)."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ".csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-role-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
              });

        $this->dataGrid = $dataGrid;
    }
}
