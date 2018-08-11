<?php

namespace AvoRed\Review\Http\Controllers;

use AvoRed\Review\Http\Requests\ReviewRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use AvoRed\Review\Models\Contracts\ProductReviewInterface;

class ReviewController extends Controller
{
    /**
     *
     * @var \AvoRed\Subscribe\Models\Repository\SubscribeRepository;
     */
    protected $repository;

    public function __construct(ProductReviewInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(ReviewRequest $request)
    {
        if (Auth::check()) {
            $request->merge(['user_id' => Auth::user()->id]);
        }

        $this->repository->create($request->all());

        return redirect()->back()->with('notificationText', 'Product Review Store Successfully !!');
    }
}
