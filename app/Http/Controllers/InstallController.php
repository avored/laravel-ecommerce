<?php

namespace App\Http\Controllers;

use CrazyCommerce\Admin\Models\AdminUser;
use CrazyCommerce\Admin\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests;
use App\Http\Requests\AdminUserRequest;

class InstallController extends Controller
{
    public $extensions = [
                        'openssl',
                        'pdo',
                        'mbstring',
                        'tokenizer'];


    public function index() {
        $result = [];
        foreach ($this->extensions as $ext) {
            if(extension_loaded($ext)) {
                $result [$ext] = 'true';
            } else {
                $result [$ext] = false;
            }
        }


        return view('install.extension')->with('result', $result);

    }

    public function databaseGet() {
        return view('install.database');

    }

    public function databasePost() {
        try {
            Artisan::call('migrate');
            Artisan::call('db:seed');
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('crazy.install.admin');
    }

    public function admin() {
        return view('install.admin');
    }

    public function adminPost(AdminUserRequest $request) {

        AdminUser::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $host = str_replace("http://", "", $request->getUriForPath(""));
        $host = str_replace("https://","", $host);
        Website::create([
            'host' => $host,
            'name' => 'Defaul Website',
            'is_default' => 1
        ]);

        return redirect()->route('crazy.install.success');
    }

    public function success() {
        return view('install.success');
    }

}
