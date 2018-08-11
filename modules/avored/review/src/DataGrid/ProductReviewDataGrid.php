<?php

namespace AvoRed\Review\DataGrid;

use AvoRed\Framework\DataGrid\Facade as DataGrid;

class ProductReviewDataGrid
{

    /**
     * Data Grid Manager Object
     *
     *
     * @var \AvoRed\Framework\DataGrid\Manager $dataGrid
     */
    public $dataGrid;

    public function __construct($model)
    {
        $dataGrid       = DataGrid::make('admin_product_review');

        $dataGrid->model($model)

            ->column('id', ['sortable' => true])
            ->column('status', ['label' => 'Status'])
            ->linkColumn('user_id',['label' => 'User'], function ($model){
                if($model->user_id > 0 ) {
                    return $model->user->fullName;
                } else {
                    return "Guest";
                }

            })
            ->linkColumn('approve',['label' => 'Approve'], function ($model){
                if($model->status == "APPROVED") {
                    return "<span class='badge badge-primary'>Approved</span>";
                } else {
                    return "<a href='".route('admin.review.approve', $model->id)."' >Approve</a>";
                }

            })
            ;

        $this->dataGrid = $dataGrid;
    }
}
