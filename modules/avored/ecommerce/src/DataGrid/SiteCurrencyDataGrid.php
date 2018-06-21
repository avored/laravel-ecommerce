<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class SiteCurrencyDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('site_currency_controller');

        $dataGrid->model($model)
                ->column('id', ['sortable' => true])
                ->column('code', ['label' => 'Code'])
                ->column('name', ['label' => 'Name'])
                ->column('conversion_rate', ['label' => 'Convertion Rate'])
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='".route('admin.site-currency.edit', $model->id)."' >Edit</a>";
                })->linkColumn('destroy', [], function ($model) {
                    return "<form id='admin-site-currency-destroy-".$model->id."'
                                    method='POST'
                                    action='".route('admin.site-currency.destroy', $model->id)."'>
                                <input name='_method' type='hidden' value='DELETE' />
                                ".csrf_field()."
                                <a href='#'
                                    onclick=\"jQuery('#admin-site-currency-destroy-$model->id').submit()\"
                                    >Destroy</a>
                            </form>";
                });

        $this->dataGrid = $dataGrid;
    }
}
