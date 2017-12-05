<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Mage2 to newer
 * versions in the future. If you wish to customize Mage2 for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Mage2\Ecommerce\Models\Database\Review;
use Mage2\Ecommerce\Http\Requests\ReviewRequest;
use Mage2\Ecommerce\Models\Database\User;

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
