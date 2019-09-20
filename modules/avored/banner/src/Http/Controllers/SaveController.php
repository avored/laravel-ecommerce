<?php

namespace AvoRed\Banner\Http\Controllers;

use AvoRed\Banner\Http\Requests\BannerRequest;
use AvoRed\Banner\Models\Database\Banner;

class SaveController
{
   /**
     * Save the specified resource from storage.
     * @param \AvoRed\Banner\Http\Requests\BannerRequest  $request
     * @param \AvoRed\Banner\Models\Database\Banner $banner
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(BannerRequest $request, Banner $banner)
    {
        $banner->fill($request->all())->save();
        
        return redirect()->route('admin.banner.table');
    }
}
