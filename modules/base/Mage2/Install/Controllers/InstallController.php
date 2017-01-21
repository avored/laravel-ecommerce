<?php

namespace Mage2\Install\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Mage2\User\Models\AdminUser;
use Mage2\Framework\System\Controllers\Controller;
use Mage2\Install\Models\Website;
use Mage2\Install\Requests\AdminUserRequest;
use Mage2\User\Models\Role;
use Mage2\System\Models\Configuration;
use Mage2\Framework\Module\Facades\Module;
use Illuminate\Support\Facades\Session;

class InstallController extends Controller
{

    public $extensions = [
        'openssl',
        'pdo',
        'mbstring',
        'tokenizer',
        'curl',];

    public function index()
    {


        $result = [];
        foreach ($this->extensions as $ext) {
            if (extension_loaded($ext)) {
                $result [$ext] = 'true';
            } else {
                $result [$ext] = false;
            }
        }


        return view('mage2install::install.extension')->with('result', $result);
    }

    public function databaseTableGet()
    {

        $sessionData = session()->get('install-module');

        $modules = Module::systemAll();

        if (!Session::has('install-module')) {

            foreach ($modules as $module) {
                $sessionData [$module->getIdentifier()] = 'uninstall';
            }

            session()->put('install-module', $sessionData);
            //dd(session()->get('install-module'));
        }

        foreach($sessionData as $identifier => $status) {
            if($status == "uninstall") {
                break;
            }
        }


        var_dump($identifier);
        return view('mage2install::install.database-table')
                                ->with('modules', $modules)
                                ->with('sessionData',$sessionData)
                                ->with('identifier',$identifier);
    }

    public function databaseTablePost(Request $request)
    {

        $hasUninstallModule = false;
        $sessionData = Session::pull('install-module');
        $identifier = $request->get('identifier');

        $module = Module::get($identifier);


        try {

            //foreach ($modules as $module) {
            $identifier = $module->getIdentifier();
            Artisan::call('mage2:module:install', ['moduleidentifier' => $identifier]);
            //}
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }



        foreach($sessionData as $setIdentifier => $status) {
            if($setIdentifier == $identifier) {
                $sessionData[$setIdentifier] = "install";
            }
        }
        //dd($sessionData);

        Session::put('install-module',$sessionData);

        //dd(Session::get('install-module'));

        foreach($sessionData as $identifier => $status) {
            if($status == "uninstall") {
                $hasUninstallModule = true;
                break;
            }
        }

        /*
         *

        try {
            Artisan::call('mage2:migrate');
            //Artisan::call('db:seed');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        */
        if(true === $hasUninstallModule) {
            return redirect()->route('mage2.install.database.table.get');
        }

        return redirect()->route('mage2.install.admin');
        //return redirect()->route('mage2.install.database.data.get');
    }

    public function databaseDataGet()
    {
        return view('mage2install::install.database-data');
    }

    public function databaseDataPost()
    {
        try {
            //Artisan::call('mage2:migrate');
            Artisan::call('mage2:dbseed');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('mage2.install.admin');
    }

    public function admin()
    {
        return view('mage2install::install.admin');
    }

    public function adminPost(AdminUserRequest $request)
    {
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

    public function success()
    {
        return view('mage2install::install.success');
    }

}
