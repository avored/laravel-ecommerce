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
 * versions in the future. If you wish to customize Mage2 for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Http\Controllers\Admin;

use Mage2\Ecommerce\Models\Database\Subscriber;
use Mage2\Ecommerce\Http\Requests\Admin\SubscriberRequest;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;

class SubscriberController extends AdminController
{

    /**
     * Display a listing of the Subscriber.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(Subscriber::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('name')
            ->column('email')
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.subscriber.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-subscriber-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.subscriber.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-subscriber-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });

        return view('mage2-ecommerce::admin.subscriber.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2-ecommerce::admin.subscriber.create');
    }

    /**
     * Store a newly created subscriber in database.
     *
     * @param \Mage2\Ecommerce\Http\Requests\Admin\SubscriberRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriberRequest $request)
    {
        Subscriber::create($request->all());

        return redirect()->route('admin.subscriber.index');
    }

    /**
     * Show the form for editing the specified subscriber.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscriber = Subscriber::findorfail($id);

        return view('mage2-ecommerce::admin.subscriber.edit')->with('model', $subscriber);
    }

    /**
     * Update the specified subscriber in database.
     *
     * @param \Mage2\Ecommerce\Http\Requests\Admin\Subscriber $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SubscriberRequest $request, $id)
    {
        $subscriber = Subscriber::findorfail($id);
        $subscriber->update($request->all());

        return redirect()->route('admin.subscriber.index');
    }

    /**
     * Remove the specified subscriber from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subscriber::destroy($id);

        return redirect()->route('admin.subscriber.index');
    }
}
