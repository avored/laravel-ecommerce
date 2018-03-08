<?php
namespace AvoRed\Ecommerce\DataGrid;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'datagrid';
    }
}
