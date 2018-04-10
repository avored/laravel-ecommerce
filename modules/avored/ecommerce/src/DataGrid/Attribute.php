<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class Attribute
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_attribute_controller');

        $dataGrid->model($model)
                ->column('name', ['label' => 'Name', 'sortable' => true])
                ->column('identifier', ['sortable' => true])
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='".route('admin.attribute.edit', $model->id)."' >Edit</a>";
                })->linkColumn('destroy', [], function ($model) {
                    return "<form id='admin-attribute-destroy-".$model->id."'
                                                method='POST'
                                                action='".route('admin.attribute.destroy', $model->id)."'>
                                            <input name='_method' type='hidden' value='DELETE' />
                                            ".csrf_field()."
                                            <a href='#'
                                                onclick=\"jQuery('#admin-attribute-destroy-$model->id').submit()\"
                                                >Destroy</a>
                                        </form>";
                });

        $this->dataGrid = $dataGrid;
    }
}
