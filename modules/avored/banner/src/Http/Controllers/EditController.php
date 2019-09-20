<?php

namespace AvoRed\Banner\Http\Controllers;

use AvoRed\Banner\Models\Database\Banner;
use AvoRed\Banner\ViewModels\EditViewModel;

class EditController
{
    public function __invoke(Banner $banner)
    {
        return view(
            'a-banner::banner.edit',
            new EditViewModel($banner)
        );
    }
}
