<?php

namespace Mage2\Install\Controllers;

use Illuminate\Support\Facades\Artisan;
use Mage2\User\Models\AdminUser;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Install\Models\Website;
use Mage2\Install\Requests\AdminUserRequest;
use Mage2\User\Models\Role;
use Mage2\Configuration\Models\Configuration;


class InstallController extends Controller {

    public $extensions = [
        'openssl',
        'pdo',
        'mbstring',
        'tokenizer',
        'curl',];

    public function index() {

        $result = [];
        foreach ($this->extensions as $ext) {
            if (extension_loaded($ext)) {
                $result [$ext] = 'true';
            } else {
                $result [$ext] = false;
            }
        }


        return view('install.extension')->with('result', $result);
    }

    public function databaseTableGet() {
        return view('install.database-table');
    }

    public function databaseTablePost() {
        try {
            Artisan::call('mage2:migrate');
            //Artisan::call('db:seed');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('mage2.install.database.data.get');
    }

    public function databaseDataGet() {
        return view('install.database-data');
    }
    public function databaseDataPost() {
        try {
            //Artisan::call('mage2:migrate');
            Artisan::call('db:seed');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('mage2.install.admin');
    }

    public function admin() {
        return view('install.admin');
    }

    public function adminPost(AdminUserRequest $request) {
        $role = Role::create(['name' => 'administraotr', 'description' => 'Administrator Role has all access']);

        AdminUser::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'is_super_admin' => 1,
            'role_id' => $role->id,
        ]);

        $host = str_replace('http://', '', $request->getUriForPath(''));
        $host = str_replace('https://', '', $host);
        $website = Website::create([
                    'host' => $host,
                    'name' => 'Defaul Website',
                    'is_default' => 1,
        ]);

        Configuration::create(['configuration_key' => 'active_theme_identifier', 
                                'configuration_value' => 'mage2-basic',
                                'website_id' => $website->id]);
        
        Configuration::create(['configuration_key' => 'active_theme_path', 
                                'configuration_value' => base_path('themes\mage2\basic'),
                                'website_id' => $website->id]);
        Configuration::create(['configuration_key' => 'mage2_catalog_no_of_product_category_page', 
                                'configuration_value' => 9,
                                'website_id' => $website->id]);
        Configuration::create(['configuration_key' => 'mage2_catalog_cart_page_display_taxamount', 
                                'configuration_value' => 'yes',
                                'website_id' => $website->id]);
        Configuration::create(['configuration_key' => 'mage2_tax_class_percentage_of_tax', 
                                'configuration_value' => 15,
                                'website_id' => $website->id]);
        
        return redirect()->route('mage2.install.success');
    }

    public function success() {
        return view('install.success');
    }

}
