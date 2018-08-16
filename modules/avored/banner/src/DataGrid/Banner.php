<?php

namespace AvoRed\Banner\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class Banner
{
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid = DataGrid::make('admin_banner_controller');

        $dataGrid->model($model)
            ->column('id', ['sortable' => true])
            ->column('name', ['label' => 'Name'])
            ->linkColumn('image', [], function ($model) {
                return "<img src='".asset($model->image_path)."' style='max-height:75px' alt='".$model->alt_text."' />";
            })
            ->linkColumn('edit', [], function ($model) {
                return "<a href='".route('admin.banner.edit', $model->id)."' >Edit</a>";
            })->linkColumn('show', [], function ($model) {
                return "<a href='".route('admin.banner.show', $model->id)."' >Show</a>";
            });

        $this->dataGrid = $dataGrid;
    }
}
