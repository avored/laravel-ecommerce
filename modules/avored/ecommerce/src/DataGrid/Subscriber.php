<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class Subscriber {

      public $dataGrid;

      public function __construct ($model) {
          $dataGrid = DataGrid::make('admin_attribute_controller');

          $dataGrid->model($model)
          ->column('id',['sortable' => true])
          ->column('name')
          ->column('email')
          ->linkColumn('edit',[], function($model) {
              return "<a href='". route('admin.subscriber.edit', $model->id)."' >Edit</a>";

          })->linkColumn('destroy',[], function($model) {
              return "<form id='admin-subscriber-destroy-".$model->id."'
                                          method='POST'
                                          action='".route('admin.subscriber.destroy', $model->id) ."'>
                                      <input name='_method' type='hidden' value='DELETE' />
                                      ". csrf_field()."
                                      <a href='#'
                                          onclick=\"jQuery('#admin-subscriber-destroy-$model->id').submit()\"
                                          >Destroy</a>
                                  </form>";
          });

          $this->dataGrid = $dataGrid;

      }


}
