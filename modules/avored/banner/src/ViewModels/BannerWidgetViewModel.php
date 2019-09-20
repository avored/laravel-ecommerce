<?php

namespace AvoRed\Banner\ViewModels;

use AvoRed\Banner\Models\Contracts\BannerInterface;
use Spatie\ViewModels\ViewModel;

class BannerWidgetViewModel extends ViewModel
{
    protected $repository;

    public function __construct()
    {
        $this->repository = app(BannerInterface::class);
    }

    public function banners()
    {
        return $this->repository->all();
    }
}
