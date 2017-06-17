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
namespace Mage2\Sale\Controllers\Admin;

use Illuminate\Support\Collection;
use Mage2\Sale\Models\GiftCoupon;
use Mage2\Sale\Requests\GiftCouponRequest;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Framework\DataGrid\Facades\DataGrid;


class GiftCouponController extends AdminController
{

    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new GiftCoupon());
    }


    /**
     * Display a listing of the Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('mage2saleadmin::gift-coupon.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('mage2saleadmin::gift-coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Catalog\Requests\CategoryRequest $request
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

        $giftCoupon = GiftCoupon::findorfail($id);

        return view('mage2saleadmin::gift-coupon.edit')
            ->with('giftCoupon', $giftCoupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Sale\Requests\GiftCouponRequest $request
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
