<?php
namespace AvoRed\Subscribe\Http\Controllers;

use AvoRed\Subscribe\Http\Requests\SubscribeRequest;
use AvoRed\Ecommerce\Http\Controllers\Controller;
use AvoRed\Subscribe\Models\Contracts\SubscribeInterface;

class SubscribeController extends Controller
{

    /**
     * Show the application dashboard.
     * @param \AvoRed\Subscribe\Http\Requests\SubscribeRequest
     * @return \Illuminate\Http\Response
     */
    public function store(SubscribeRequest $request)
    {
        $request->merge(['email' => $request->get('subscribe_email')]);

        $subscribeRepository = app(SubscribeInterface::class);
        Subscribe::create($request->all());

        return redirect()->back()
                    ->with('notificationSuccess','Subscriber Address Successfully!');

    }
}