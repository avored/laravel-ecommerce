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
namespace Mage2\Catalog\Controllers\Admin;

use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Framework\DataGrid\Facades\DataGrid;
use Mage2\Catalog\Requests\AttributeRequest;

class AttributeController extends AdminController
{
    public function getDataGrid()
    {
        return $users = DataGrid::dataTableData(new ProductAttribute());
    }


    public function index()
    {
        return view('mage2catalog::admin.catalog.attribute.index');
    }

    public function create()
    {
        return view('mage2catalog::admin.catalog.attribute.create');
    }

    public function store(AttributeRequest $request)
    {

        $productAttribute = ProductAttribute::create($request->all());

        $this->_saveDropdownOptions($productAttribute, $request);


        return redirect()->route('admin.attribute.index');


    }

    public function edit($id)
    {

        $attribute = ProductAttribute::find($id);
        return view('mage2catalog::admin.catalog.attribute.edit')->with('attribute', $attribute);

    }

    public function update(AttributeRequest $request, $id)
    {

        $attribute = ProductAttribute::find($id);
        $attribute->update($request->all());


        $this->_saveDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index');

    }

    /**
     *
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        ProductAttribute::destroy($id);

        return redirect()->route('admin.attribute.index');
    }


    private function _saveDropdownOptions($productAttribute, $request)
    {

        if (null !== $request->get('dropdown-options')) {

            foreach ($request->get('dropdown-options') as $key => $val) {
                if ($key == '__RANDOM_STRING__') {
                    continue;
                }
                if (!is_int($key)) {
                    $productAttribute->attributeDropdownOptions()->create($val);
                }
            }
        }
    }
}
