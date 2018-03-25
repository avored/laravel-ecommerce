<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class AdminUser
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_user_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('first_name', ['label' => 'First Name'])
                ->column('last_name', ['label' => 'Last Name'])
                ->linkColumn('show_api', ['label' => 'Show API'], function ($model) {
                    return "<a href='".route('admin.admin-user.show.api')."' >Show API</a>";
                })
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='".route('admin.admin-user.edit', $model->id)."' >Edit</a>";
                })->linkColumn('destroy', [], function ($model) {
                    return "<form id='admin-admin-user-destroy-".$model->id."'
                                                method='POST'
                                                action='".route('admin.admin-user.destroy', $model->id)."'>
                                            <input name='_method' type='hidden' value='DELETE' />
                                            ".csrf_field()."
                                            <a href='#'
                                                onclick=\"jQuery('#admin-admin-user-destroy-$model->id').submit()\"
                                                >Destroy</a>
                                        </form>";
                });

        $this->dataGrid = $dataGrid;
    }
}
