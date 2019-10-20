<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SaveRequest;
use App\ViewModels\Account\EditViewModel;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    /**
     * Save the user account details.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke(SaveRequest $request)
    {
        Auth::user()->fill($request->all())->save();

        return redirect()->route('account.dashboard');
    }
}
