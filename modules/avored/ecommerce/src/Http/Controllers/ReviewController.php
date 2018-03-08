<?php
namespace AvoRed\Ecommerce\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use AvoRed\Ecommerce\Models\Database\Review;
use AvoRed\Ecommerce\Http\Requests\ReviewRequest;
use AvoRed\Ecommerce\Models\Database\User;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {

        if (!Auth::check()) {
            $user = User::where('email', '=', $request->get('email'))->get()->first();

            if (null === $user) {

                $requestData = $request->all();

                $password = bcrypt(str_random($length = 6));

                $requestData['password'] = $password;
                $requestData['status'] = 'GUEST';

                //dd($requestData->all());
                $user = User::create($requestData);
            }
        } else {
            $user = Auth::user();
        }
        $request->merge(['user_id' => $user->id]);
        Review::create($request->all());

        return redirect()->back()->with('notificationText', 'Review Added SucessFully!');
    }
}
