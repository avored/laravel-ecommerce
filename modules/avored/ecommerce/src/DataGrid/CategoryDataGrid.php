<?php

namespace AvoRed\Ecommerce\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;
use AvoRed\Framework\DataGrid\Columns\TextColumn;

class CategoryDataGrid
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_category_controller');

        $dataGrid->model($model)
                ->column('name', function (TextColumn $column) {
                    $column->identifier('name')
                            ->label('Name')
                            ->sortable(true)
                            ->canFilter(true);
                })
                ->column('slug', function (TextColumn $column) {
                    $column->identifier('slug')
                            ->label('Slug')
                            ->sortable(true)
                            ->canFilter(true);
                })
                ->linkColumn('edit', [], function ($model) {
                    return "<a href='" . route('admin.category.edit', $model->id) . "' >Edit</a>";
                })->linkColumn('destroy', [], function ($model) {
                    return "<form id='admin-category-destroy-" . $model->id . "'
                                      method='POST'
                                      action='" . route('admin.category.destroy', $model->id) . "'>
                                  <input name='_method' type='hidden' value='DELETE' />
                                  " . csrf_field() . "
                                  <a href='#'
                                      onclick=\"jQuery('#admin-category-destroy-$model->id').submit()\"
                                      >Destroy</a>
                              </form>";
                });

        $this->dataGrid = $dataGrid;
    }
}
