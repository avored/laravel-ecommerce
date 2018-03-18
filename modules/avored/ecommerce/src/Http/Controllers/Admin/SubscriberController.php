<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use AvoRed\Ecommerce\Models\Database\Subscriber;
use AvoRed\Ecommerce\Http\Requests\Admin\SubscriberRequest;
use AvoRed\Ecommerce\DataGrid\Subscriber as SubscriberGrid;

class SubscriberController extends AdminController
{

    /**
     * Display a listing of the Subscriber.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = new SubscriberGrid(Subscriber::query());


        return view('avored-ecommerce::admin.subscriber.index')->with('dataGrid', $grid->dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::admin.subscriber.create');
    }

    /**
     * Store a newly created subscriber in database.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\Admin\SubscriberRequest $request
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

        return view('avored-ecommerce::admin.subscriber.edit')->with('model', $subscriber);
    }

    /**
     * Update the specified subscriber in database.
     *
     * @param \AvoRed\Ecommerce\Http\Requests\Admin\Subscriber $request
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
