<?php
namespace Mage2\Order\Controllers\Admin;

use Mage2\Order\Models\OrderStatus;
use Mage2\Order\Requests\OrderStatusRequest;
use Mage2\Framework\Http\Controllers\Controller;

class OrderStatusController extends Controller
{
   
    public function __construct(){
       
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderStatuses = OrderStatus::paginate(10);
        return view('admin.order-status.index')
            ->with('orderStatuses' , $orderStatuses)
            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.order-status.create')

            ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Mage2\Order\Requests\orderStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusRequest $request)
    {
        if($request->get('is_default') == 1) {
            foreach(OrderStatus::where('is_default','=',1)->get() as $orderStatus) {
                $orderStatus->is_default = 0;
                $orderStatus->update();
            }
        }

        OrderStatus::create($request->all());

        return redirect()->route('admin.order-status.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $orderStatus = OrderStatus::findorfail($id);
        return view('admin.order-status.edit')
            ->with('orderStatus', $orderStatus)

            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Mage2\Order\Requests\orderStatusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(orderStatusRequest $request, $id)
    {
        $orderStatus = OrderStatus::findorfail($id);

        $orderStatus->update($request->all());

        return redirect()->route('admin.order-status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrderStatus::destroy($id);
        return redirect()->route('admin.order-status.index');
    }

}
