<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UploadImageRequest;
use App\ViewModels\Account\EditViewModel;
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
        $dbPath = $image->storePublicly('uploads/user', 'public');

        return response()->json(['success' => true,'image' => $dbPath]);
    }
}
