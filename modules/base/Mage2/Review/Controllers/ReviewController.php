<?php

namespace Mage2\Review\Controllers;

use Mage2\Review\Models\Review;
use Mage2\Framework\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mage2\Review\Requests\ReviewRequest;
use Mage2\User\Models\User;

class ReviewController extends Controller
{


    public function store(ReviewRequest $request)
    {
        if (!Auth::check()) {
            $user = User::where('email', '=', $request->get('email'))->get()->first();

            if (null === $user) {
                $request->merge(['password' => str_random($length = 6)]);
                $user = User::create($request->all());
            }
        } else {
            $user = Auth::user();
        }

        $request->merge(['user_id' => $user->id]);
        Review::create($request->all());

        return redirect()->back();
    }

}
