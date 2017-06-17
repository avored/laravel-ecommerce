<?php

namespace Mage2\Framework\DataGrid\Facades;

use Illuminate\Support\Facades\Facade;

class DataGrid extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'datagrid';
    }
}
