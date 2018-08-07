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
            })->linkColumn('destroy', [], function ($model) {
                return "<form id='admin-banner-destroy-".$model->id."'
                                                method='POST'
                                                action='".route('admin.banner.destroy', $model->id)."'>
                                            <input name='_method' type='hidden' value='DELETE' />
                                            ".csrf_field()."
                                            <a href='#'
                                                onclick=\"jQuery('#admin-banner-destroy-$model->id').submit()\"
                                                >Destroy</a>
                                        </form>";
            });

        $this->dataGrid = $dataGrid;
    }
}
