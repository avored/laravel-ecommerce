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
namespace Mage2\Review\Controllers\Admin;

use Illuminate\Http\Request;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Review\Models\Review;
use Mage2\Framework\DataGrid\Facades\DataGrid;

class ReviewController extends AdminController
{

    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new Review());
    }


    public function index()
    {

        return view('mage2reviewadmin::review.index');
    }

    public function edit($id)
    {
        $review = Review::find($id);

        return view('mage2reviewadmin::review.edit')->with('review', $review);
    }

    public function update($id, Request $request)
    {
        $review = Review::find($id);
        $review->update($request->all());

        return redirect()->route('admin.review.index');
    }
}
