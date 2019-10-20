<?php
namespace AvoRed\Review\Http\ViewComposers;

use AvoRed\Review\Database\Contracts\ProductReviewModelInterface;
use Illuminate\View\View;

class ProductReviewComposer
{
    /**
     * Bind data to the view.
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $repository = app(ProductReviewModelInterface::class);
        $productId  = $view->offsetGet('product')->id;
        $reviews    = $repository->getAllReviewsByProductId($productId);

        $view->with('reviews', $reviews);
    }
}
