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
    public function index(ReviewRequest $request)
    {
        if (Auth::guard('customer')->check()) {
            $request->merge(['name' => Auth::guard('customer')->user()->full_name]);
            $request->merge(['email' => Auth::guard('customer')->user()->email]);
        }

        $repository = app(ProductReviewModelInterface::class);
        $repository->create($request->all());
        
        return redirect()
            ->back()
            ->with('notificationText', __('a-review.review.notificationText'));
    }


    public function reviewJs()
    {
        $file = __DIR__ . '/../../../dist/js/review.js';

        $expires = strtotime('+1 year');
        $lastModified = filemtime($file);
        $cacheControl = 'public, max-age=31536000';

        return response()->file($file, [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Expires' => sprintf('%s GMT', gmdate('D, d M Y H:i:s', $expires)),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => sprintf('%s GMT', gmdate('D, d M Y H:i:s', $lastModified)),
        ]);
    }

    public function adminReviewJs()
    {
        $file = __DIR__ . '/../../../dist/js/admin-review.js';

        $expires = strtotime('+1 year');
        $lastModified = filemtime($file);
        $cacheControl = 'public, max-age=31536000';

        return response()->file($file, [
            'Content-Type' => 'application/javascript; charset=utf-8',
            'Expires' => sprintf('%s GMT', gmdate('D, d M Y H:i:s', $expires)),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => sprintf('%s GMT', gmdate('D, d M Y H:i:s', $lastModified)),
        ]);
    }
}
