<?php

namespace AvoRed\Banner\ViewModels;

use AvoRed\Banner\Models\Database\Banner;
use Spatie\ViewModels\ViewModel;

class EditViewModel extends ViewModel
{
    protected $model;

    public function __construct(Banner $banner)
    {
        $this->model = $banner;
    }

    public function banner()
    {
        return $this->model;
    }
}
