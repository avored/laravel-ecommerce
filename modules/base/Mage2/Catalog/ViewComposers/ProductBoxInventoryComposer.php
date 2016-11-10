<?php

namespace Mage2\Catalog\ViewComposers;

use Mage2\Attribute\Models\ProductAttribute;
use Illuminate\View\View;

class ProductBoxInventoryComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
        $productAttrobuteModel = new ProductAttribute();
        $trackStockOptions = $productAttrobuteModel->getTrackStockOptions();
        $inStockOptions = $productAttrobuteModel->getInStockOptions();


        $isTaxableOptions = $productAttrobuteModel->getIsTaxableOptions();


        $view
                ->with('isTaxableOptions', $isTaxableOptions)
                ->with('trackStockOptions', $trackStockOptions)
                ->with('inStockOptions', $inStockOptions);
    }

}
