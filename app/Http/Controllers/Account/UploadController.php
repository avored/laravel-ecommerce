<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\ViewModels\Account\EditViewModel;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    /**
     * Show the user account dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        return view('account.upload', new EditViewModel(Auth::user()));
    }
}
