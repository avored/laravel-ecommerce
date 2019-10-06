<?php

namespace AvoRed\Review\Http\Controllers;

use AvoRed\Review\Http\Requests\ReviewRequest;
use App\Http\Controllers\Controller;
use AvoRed\Review\Database\Contracts\ProductReviewModelInterface;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

      /**
     * Construct for the Product Review Controller
     * @param \AvoRed\Review\Http\Requests\ReviewRequest $request
     * @return \Illuminate\View\View $view
     */
    public function __invoke(ReviewRequest $request)
    {
        if (Auth::check()) {
            $request->merge(['name' => Auth::user()->name]);
            $request->merge(['email' => Auth::user()->email]);
        }

        $repository = app(ProductReviewModelInterface::class);
        $repository->create($request->all());
        
        return redirect()
            ->back()
            ->with('notificationText', __('a-review.review.notificationText'));
    }
}
