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
 * Do not edit or add to this file if you wish to upgrade Mage2 to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Mage2\Ecommerce\Models\Database\Category;
use Mage2\Ecommerce\Http\Requests\CategoryRequest;
use Mage2\Framework\System\Controllers\ApiController;

class CategoryController extends ApiController
{

    public function index()
    {
        $data = Category::all();
        return JsonResponse::create(['data' => $data,'status' => true]); ;
    }

    public function store(CategoryRequest $request)
    {
        $data = Category::create($request->all());
        return JsonResponse::create(['data' => $data,'status' => true],201); ;
    }

    public function show($id)
    {
        $data = Category::find($id);
        return JsonResponse::create(['data' => $data,'status' => true]); ;
    }


    public function update(CategoryRequest $request,$id)
    {
        $data = Category::find($id);
        $data->update($request->all());

        return JsonResponse::create(['data' => $data,'status' => true]); ;
    }

    public function destroy($id) {
        Category::destroy($id);

        return JsonResponse::create(null, 204); ;
    }
}
