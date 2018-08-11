<?php

namespace AvoRed\Review\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use AvoRed\Review\DataGrid\ProductReviewDataGrid;
use AvoRed\Review\Models\Database\ProductReview;
use AvoRed\Review\Models\Contracts\ProductReviewInterface;

class ReviewController extends Controller
{
    /**
     *
     * @var \AvoRed\Review\Models\Repository\ProductReviewRepository;
     */
    protected $repository;

    public function __construct(ProductReviewInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index() {

        $grid = new ProductReviewDataGrid($this->repository->query());

        return view('avored-review::admin.review.index')->with('dataGrid', $grid->dataGrid);
    }


    public function approve(ProductReview $productReview) {
        $productReview->update(['status' => 'APPROVED']);

        return redirect()->route('admin.review.index');
    }

}
