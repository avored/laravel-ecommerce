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

use Mage2\Ecommerce\Models\Database\GiftCoupon;
use Mage2\Ecommerce\Http\Requests\GiftCouponRequest;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;

class GiftCouponController extends AdminController
{

    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(GiftCoupon::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.gift-coupon.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-gift-coupon-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.gift-coupon.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-gift-coupon-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });
        return view('mage2-ecommerce::admin.gift-coupon.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('mage2-ecommerce::admin.gift-coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\GiftCouponRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GiftCouponRequest $request)
    {

        GiftCoupon::create($request->all());

        return redirect()->route('admin.gift-coupon.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $giftCoupon = GiftCoupon::find($id);
        return view('mage2-ecommerce::admin.gift-coupon.edit')->with('model', $giftCoupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\GiftCouponRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(GiftCouponRequest $request, $id)
    {
        $giftCoupon = GiftCoupon::findorfail($id);

        $giftCoupon->update($request->all());

        return redirect()->route('admin.gift-coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        GiftCoupon::destroy($id);
        return redirect()->route('admin.gift-coupon.index');
    }
}
