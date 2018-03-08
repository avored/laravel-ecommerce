<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use AvoRed\Ecommerce\Models\Database\Configuration;
use AvoRed\Ecommerce\Models\Database\OrderStatus;

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

        return view('avored-ecommerce::admin.order.configuration.index')
            ->with('orderStatusOption',$orderStatusOption)
            ->with('configurations', $configurations);
    }
}
