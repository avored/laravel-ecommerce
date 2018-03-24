<?php
namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use AvoRed\Ecommerce\Models\Database\Subscriber;

class SubscribeController extends Controller
{

    /**
     * Show the application dashboard.
     * @param \App\Http\Requests\SubscribeRequest
     * @return \Illuminate\Http\Response
     */
    public function store(SubscribeRequest $request)
    {

        $request->merge(['email' => $request->get('subscriber_email')]);

        Subscriber::create($request->all());

        return redirect()->back()->with('notificationSuccess','Subscriber Address Successfully!');

    }
}