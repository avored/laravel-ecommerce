<?php
namespace Mage2\Ecommerce\DataGrid\Columns;

use Illuminate\Support\Facades\Route;

class TextColumn  extends AbstractColumn {


    protected $type = 'text';


    public function ascUrl() {
        $currentRouteName = Route::getCurrentRoute()->getName();
        return route($currentRouteName, ['asc' => $this->identifier()]);
    }


    public function descUrl() {
        $currentRouteName = Route::getCurrentRoute()->getName();
        return route($currentRouteName, ['desc' => $this->identifier()]);
    }
}