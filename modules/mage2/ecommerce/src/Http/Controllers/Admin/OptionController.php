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
use Illuminate\Support\Collection;
use Mage2\Ecommerce\Models\Database\Option;
use Mage2\Ecommerce\Http\Requests\OptionRequest;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;
use Mage2\Ecommerce\Models\Database\OptionDropdownOption;

class OptionController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataGrid = DataGrid::model(Option::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.option.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-option-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.option.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-option-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });
        return view('mage2-ecommerce::admin.option.index')
                    ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2-ecommerce::admin.option.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\OptionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OptionRequest $request)
    {
        try {
            $option = Option::create($request->all());
            $this->_saveDropdownOptions($option , $request);

        } catch(\Exception $e) {
            throw new \Exception('Error While creating Option');
        }


        return redirect()->route('admin.option.index');
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
        $option = Option::findorfail($id);
        return view('mage2-ecommerce::admin.option.edit')
                    ->with('model', $option);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\CountryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OptionRequest $request, $id)
    {
        try {

            $option = Option::findorfail($id);
            $option->update($request->all());

            $this->_saveDropdownOptions($option , $request);
        } catch(\Exception $e) {
            throw new \Exception('Error While updating Option');
        }

        return redirect()->route('admin.option.index');
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

        try {
            Option::destroy($id);
        } catch(\Exception $e) {
            throw new \Exception('Error While destroing Option');
        }
        return redirect()->route('admin.option.index');
    }

    public function optionCombinationModal(Request $request) {

        $options = Collection::make([]);

        $productId = $request->get('product_id');
        $optionIds = $request->get('options');

        foreach ($optionIds as $optionId) {
            $options->push(Option::findorfail($optionId));
        }

        return view('mage2-ecommerce::admin.product.option-combination')
                ->with('options', $options)
                ->with('product_id', $productId);
    }

    public function optionCombinationUpdate(Request $request){
        return $request->all();
    }


    private function _saveDropdownOptions($option, $request)
    {

        if (null !== $request->get('dropdown-options')) {

            //dd($request->get('dropdown-options'));
            foreach ($request->get('dropdown-options') as $key => $val) {

                if ($key == '__RANDOM_STRING__') {
                    continue;
                }


                if (!is_int($key)) {
                    $option->optionDropdownOptions()->create($val);
                }
                if(is_int($key)) {
                    $dropdownOption = OptionDropdownOption::find($key);
                    $dropdownOption->update($val);
                }
            }
        }
    }
}
