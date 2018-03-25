<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class Page
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_page_controller');

        $dataGrid->model($model)
              ->column('id', ['sortable' => true])
              ->column('name')
              ->column('slug')
              ->column('meta_title')
              ->linkColumn('edit', [], function ($model) {
                  return "<a href='".route('admin.page.edit', $model->id)."' >Edit</a>";
              })->linkColumn('destroy', [], function ($model) {
                  return "<form id='admin-page-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.page.destroy', $model->id)."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ".csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-page-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
              });

        $this->dataGrid = $dataGrid;
    }
}
