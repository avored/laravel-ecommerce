<?php

namespace AvoRed\Related\Http\ViewComposers;

use AvoRed\Related\DataGrid\RelatedProductDataGrid;
use Illuminate\View\View;
use AvoRed\Framework\Models\Contracts\ProductInterface;

class RelatedProductComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $productId = $view->offsetGet('model')->id;
        $productRepository = app(ProductInterface::class);
        $productQuery = $productRepository->query();
        $relatedProductGrid = new RelatedProductDataGrid($productQuery, $productId);

        $view->with('dataGrid', $relatedProductGrid->dataGrid);
    }
}
