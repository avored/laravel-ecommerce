<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SaveRequest;
use Illuminate\Support\Facades\Auth;


class SaveController extends Controller
{
    /**
     * Save the user account details.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke(SaveRequest $request)
    {
        /** @var \AvoRed\Framework\Database\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();
        //$customer->update($request->all());

        $customer->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            //'password' => Hash::make($request->password)
       ]);

        return redirect()->route('account.dashboard');
    }
}
