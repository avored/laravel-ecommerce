<?php

namespace AvoRed\Banner\Http\Controllers;

use AvoRed\Banner\Http\Requests\BannerImageRequest;

class UploadController
{

    public function __invoke(BannerImageRequest $request)
    {
        $image = $request->file('file');
        $dbPath = $image->storePublicly('uploads/banners/', 'public');

        return response()->json(['success' => true,'image' => $dbPath]);
    }
}
