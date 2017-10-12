<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
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
