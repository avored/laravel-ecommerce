<?php

namespace Mage2\Install\Controllers;

use Illuminate\Support\Facades\Artisan;
use Mage2\Framework\Http\Controllers\Controller;
use Mage2\Auth\Models\AdminUser;
use Mage2\Install\Models\Website;
use Mage2\Install\Requests\AdminUserRequest;

class InstallController extends Controller
{


   
    public $extensions = [
                        'openssl',
                        'pdo',
                        'mbstring',
                        'tokenizer',
                        'curl'];


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
            //Artisan::call('mage2:migrate');
            //Artisan::call('db:seed');
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('mage2.install.admin');
    }

    public function admin() {
        return view('install.admin');
    }

    public function adminPost(AdminUserRequest $request) {

       
        //dd($request);
        //return $request->all();
        AdminUser::create([
                                'first_name' => $request->get('first_name'),
                                'last_name' => $request->get('last_name'),
                                'email' => $request->get('email'),
                                'password' => bcrypt($request->get('password')),
                                'role_id' => 1, // @todo change this one??
                            ]);

        $host = str_replace("http://", "", $request->getUriForPath(""));
        $host = str_replace("https://","", $host);
        Website::create([
                            'host' => $host,
                            'name' => 'Defaul Website',
                            'is_default' => 1
                        ]);

        return redirect()->route('mage2.install.success');
    }

    public function success() {
        return view('install.success');
    }

}
