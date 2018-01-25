<?php
namespace Mage2\Ecommerce\Http\Controllers\Admin;

use Mage2\Ecommerce\Models\Database\Configuration;
use Mage2\Ecommerce\Models\Database\OrderStatus;

class OrderConfigController extends AdminController
{


    /**
     * Display a listing of the Catalog Configuration.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConfiguration()
    {
        $orderStatusOption = OrderStatus::all()->pluck('name','id');
        $configurations = Configuration::all()->pluck('configuration_value', 'configuration_key');

        return view('mage2-ecommerce::admin.order.configuration.index')
            ->with('orderStatusOption',$orderStatusOption)
            ->with('configurations', $configurations);
    }
}
