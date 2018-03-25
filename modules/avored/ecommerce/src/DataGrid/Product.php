<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class Product
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_product_controller');

        $dataGrid->model($model)
          ->column('id', ['sortable' => true])
          ->linkColumn('image', [], function ($model) {
              return "<img src='".$model->image->smallUrl."' style='max-height: 50px;' />";
          })->column('name')
          ->linkColumn('edit', [], function ($model) {
              return "<a href='".route('admin.product.edit', $model->id)."' >Edit</a>";
          })->linkColumn('destroy', [], function ($model) {
              return "<form id='admin-product-destroy-".$model->id."'
                                          method='POST'
                                          action='".route('admin.product.destroy', $model->id)."'>
                                      <input name='_method' type='hidden' value='DELETE' />
                                      ".csrf_field()."
                                      <a href='#'
                                          onclick=\"jQuery('#admin-product-destroy-$model->id').submit()\"
                                          >Destroy</a>
                                  </form>";
          });

        $this->dataGrid = $dataGrid;
    }
}
