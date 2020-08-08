<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UploadImageRequest;
use Illuminate\Support\Facades\Auth;

class UploadImageController extends Controller
{
    /**
     * Show the user account dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke(UploadImageRequest $request)
    {
      
        $image = $request->file('file');
        $dbPath = $image->storePublicly('uploads/user', 'avored');

        /** @var \AvoRed\Framework\Database\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();
        $customer->image_path = $dbPath;
        $customer->save();

        return redirect()->route('account.dashboard');
    }
}
