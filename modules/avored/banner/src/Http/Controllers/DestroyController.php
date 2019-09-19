<?php

namespace AvoRed\Banner\Http\Controllers;

use AvoRed\Banner\Models\Contracts\BannerInterface;
use AvoRed\Banner\Models\Database\Banner;

class DestroyController
{

    public function __invoke(Banner $banner)
    {
        $banner->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('a-banner::banner.title')]
            ),
        ]);
    }
}
