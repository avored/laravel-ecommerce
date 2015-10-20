<?php

/*
Copyright (c) 2015, Purvesh
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.

* Redistributions in binary form must reproduce the above copyright notice,
  this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.

* Neither the name of Mage2 nor the names of its
  contributors may be used to endorse or promote products derived from
  this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
    OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/
namespace App\Http\Controllers\Admin;

use Mage2\Core\Model\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\CategoryRequest;
use Mage2\Core\Model\Category;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
//use Mage2\Core\Model\Entity;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * Show user profile page.
     *
     * @return Response
     */
    public function editAccount()
    {

        $user = Auth::user();
        return view('admin.user.edit-account')->with('user', $user);
    }

    public function update(Request $request) {

        try {
            $user = Auth::user();
            $userModel = User::findorfail($user->id);
            $userModel->update($request->all());

            return redirect('/admin');

        } catch(\Exception $e) {
            throw new Exception("User update Error");
        }
    }

}
