<?php

namespace Mage2\Paypal\Controllers;

use Illuminate\Http\Request;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Paypal\Models\PaypalRecord;

class PaypalController extends Controller
{
    public function store(Request $request)
    {
        //{"paymentId":"PAY-3W537790US5969942K7U4AXA","token":"EC-8DT68046NR846771L","PayerID":"RXV7B5K9X94CQ"}
        //dd($request);
        PaypalRecord::create($request->all());

        return redirect()->route('checkout.step.review');
    }

    public function cancel(Request $request)
    {
        //@todo not sure what to do with cancel payment  now...
        //PaypalRecord::create($request->all());
        return redirect()->route('checkout.step.payment-option');
    }
}
