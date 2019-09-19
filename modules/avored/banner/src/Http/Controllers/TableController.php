<?php

namespace AvoRed\Banner\Http\Controllers;

use AvoRed\Banner\ViewModels\TableViewModel;

class TableController
{
    public function __invoke()
    {
        return view('a-banner::banner.index', new TableViewModel);
    }
}
