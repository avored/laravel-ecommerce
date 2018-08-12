<?php
namespace AvoRed\Review\Http\ViewComposers;

use Illuminate\View\View;
use AvoRed\Review\Models\Contracts\ProductReviewInterface;

class ProductReviewComposer {


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $productId = $view->offsetGet('product')->id;
        $productRepository = app(ProductReviewInterface::class);
        $reviews = $productRepository->findByProductId($productId);

        $view->with('productReviews', $reviews);
    }

}