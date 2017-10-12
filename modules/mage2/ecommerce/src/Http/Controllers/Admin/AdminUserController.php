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

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;
use Mage2\Ecommerce\Models\Database\AdminUser;
use Mage2\Ecommerce\Models\Database\Role;
use Mage2\Ecommerce\Http\Requests\AdminUserRequest;
use Mage2\Ecommerce\DataGrid\Facade as DataGrid;

class AdminUserController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(AdminUser::query()->orderBy('id','desc'))
            ->column('id',['sortable' => true])
            ->column('first_name')
            ->column('last_name')
            ->linkColumn('show_api',['label' => 'Show API'], function($model) {
                return "<a href='". route('admin.admin-user.show.api')."' >Show API</a>";
            })
            ->linkColumn('edit',[], function($model) {
                return "<a href='". route('admin.admin-user.edit', $model->id)."' >Edit</a>";

            })->linkColumn('destroy',[], function($model) {
                return "<form id='admin-admin-user-destroy-".$model->id."'
                                            method='POST'
                                            action='".route('admin.admin-user.destroy', $model->id) ."'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        ". csrf_field()."
                                        <a href='#'
                                            onclick=\"jQuery('#admin-admin-user-destroy-$model->id').submit()\"
                                            >Destroy</a>
                                    </form>";
            });
        return view('mage2-ecommerce::admin.admin-user.index')->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->_getRoleOptions();
        return view('mage2-ecommerce::admin.admin-user.create')
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\AdminUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->get('password'))]);


        //TMP only once we add user role then remove it???

        $role = Role::all()->first();
        $request->merge(['role_id' => $role->id]);

        AdminUser::create($request->all());

        return redirect()->route('admin.admin-user.index');
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
        $user = AdminUser::findorfail($id);
        $roles = $this->_getRoleOptions();
        return view('mage2-ecommerce::admin.admin-user.edit')
            ->with('model', $user)
            ->with('roles', $roles)
            ->with('editMethod', true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Mage2\Ecommerce\Http\Requests\AdminUserRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, $id)
    {
        $user = AdminUser::findorfail($id);

        $user->update($request->all());

        return redirect()->route('admin.admin-user.index');
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
        AdminUser::destroy($id);

        return redirect()->route('admin.admin-user.index');
    }

    private function _getRoleOptions()
    {
        return [0 => 'Please Select'] + Role::all()->pluck('name', 'id')->toArray();
    }

    public function apiShow() {

        $user = Auth::user();
        $client = Client::wherePasswordClient(1)->whereUserId($user->id)->first();

        return view('mage2-user::user.admin-user.show-api')->with('client', $client);
    }
}
