<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class Order
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_order_controller');

        $dataGrid->model($model)
                  ->column('id', ['sortable' => true])
                  ->column('shipping_option', ['label' => 'Shipping Option'])
                  ->column('payment_option', ['label' => 'Payment Option'])
                  ->linkColumn('order_status', ['label' => 'Order Status'], function ($model) {
                      return $model->orderStatus->name;
                  })
                  ->linkColumn('view', [], function ($model) {
                      return "<a href='".route('admin.order.view', $model->id)."' >View</a>";
                  });

        $this->dataGrid = $dataGrid;
    }
}
