<?php
namespace AvoRed\Subscribe\Http\Controllers;

use AvoRed\Subscribe\Http\Requests\SubscribeRequest;
use AvoRed\Subscribe\Models\Contracts\SubscribeInterface;
use AvoRed\Framework\System\Controllers\Controller;
use AvoRed\Subscribe\Models\Database\Subscribe;

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
        $subscribeRepository->create($request->all());

        return redirect()->back()
                    ->with('notificationSuccess','Subscriber Address Successfully!');

    }

}