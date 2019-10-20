<?php

namespace AvoRed\Review\Http\Controllers\Admin;

use AvoRed\Review\Database\Models\ProductReview;

class ReviewController
{
    public function __invoke(ProductReview $productReview)
    {
        $productReview->update(['status' => 'APPROVED']);

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.approved',
                ['attribute' => __('a-review::review.title')]
            ),
        ]);
    }
}
