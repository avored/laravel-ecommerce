<?php
namespace App\Http\Controllers;

use Mage2\Ecommerce\Http\Requests\SubscribeRequest;
use Mage2\Ecommerce\Models\Database\Subscriber;

class SubscribeController extends Controller
{

    /**
     * Show the application dashboard.
     * @param \Mage2\Ecommerce\Http\Requests\SubscribeRequest
     * @return \Illuminate\Http\Response
     */
    public function store(SubscribeRequest $request)
    {

        Subscriber::create($request->all());

        return redirect()->back()->with('notificationSuccess','Subscriber Address Successfully!');

    }
}
