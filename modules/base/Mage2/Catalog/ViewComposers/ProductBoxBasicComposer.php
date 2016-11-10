<?php

namespace Mage2\Catalog\ViewComposers;

use Mage2\Attribute\Models\ProductAttribute;
use Illuminate\View\View;

class ProductBoxBasicComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
         $productAttrobuteModel = new ProductAttribute();
            $isFeaturedOptions = $productAttrobuteModel->getIsFeaturedOptions();
            $statusOptions = $productAttrobuteModel->getStatusOptions();
            $view
                    ->with('isFeaturedOptions', $isFeaturedOptions)
                    ->with('statusOptions', $statusOptions);
    }

}
