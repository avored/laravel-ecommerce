<?php
namespace Mage2\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Mage2\Ecommerce\Models\Database\Review;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;

class ReviewController extends AdminController
{
    public function index()
    {
        $dataGrid = DataGrid::model(Review::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('product_name', ['label' => "Product Name"])
            ->column('star')
            ->column('status')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.review.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-review-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.review.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-review-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });
        return view('mage2-ecommerce::admin.review.index')->with('dataGrid', $dataGrid);
    }

    public function edit($id)
    {
        $review = Review::find($id);

        return view('mage2-ecommerce::admin.review.edit')->with('model', $review);
    }

    public function update($id, Request $request)
    {
        $review = Review::find($id);
        $review->update($request->all());

        return redirect()->route('admin.review.index');
    }
}
