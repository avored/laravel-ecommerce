<?php

namespace Mage2\Review\Controllers;

use Mage2\Review\Models\Review;
use Mage2\Framework\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{

    public function index() {
        $reviews = Review::paginate(10);

        return view('admin.review.index')->with('reviews', $reviews);
    }

    public function edit($id) {
        $review = Review::find($id);

        return view('admin.review.edit')->with('review', $review);
    }


    public function update($id , Request $request)
    {
        $review = Review::find($id);
        $review->update($request->all());

        return redirect()->route('admin.review.index');
    }

}
