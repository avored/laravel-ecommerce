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
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */

namespace Mage2\System\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;
use Mage2\System\Models\Module as ModuleModel;

class ModuleController extends AdminController
{

    /**
     * Display a listing of the theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $modelModule = new ModuleModel();
        $modules = ModuleFacade::all();

        return view('mage2system::admin.module.index')
            ->with('modules', $modules)
            ->with('modelModule', $modelModule)//->with('activeTheme', $activeTheme)
            ;
    }

    /**
     * Show the form for creating a new theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2system::admin.module.create');
    }

    /**
     * Store a newly created theme in database.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $filePath = $this->handleImageUpload($request->file('module_zip_file'));

        $zip = new \ZipArchive();

        if ($zip->open($filePath) === true) {
            $extractPath = base_path('modules/community');
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            throwException('Error in Zip Extract error.');
        }


        return redirect()->route('admin.module.index');
    }

    /**
     * Installtion of module
     *
     *
     * @param string $identifier
     */
    public function install($identifier)
    {

        $module = ModuleFacade::get($identifier);
        $moduleName = $module->getName();

        try {


            ModuleModel::create([
                'type' => 'COMMUNITY',
                'identifier' => $identifier,
                'name' => $moduleName,
            ]);

            Artisan::call('mage2:module:install', ['moduleidentifier' => $identifier]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }


        return redirect()->route('admin.module.index');
    }

    /**
     * UnInstalltion of module
     *
     *
     * @param string $identifier
     */
    public function uninstall($identifier)
    {

        try {
            //ModuleModel::where('identifier','=',$identifier)->get()->first()->delete();
            Artisan::call('mage2:module:uninstall', ['moduleidentifier' => $identifier]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }


        return redirect()->route('admin.module.index');

        /**
         * $module = ModuleFacade::get($identifier);
         *
         * dd($module);
         *
         * $moduleName = $module->getName();
         * $moduleDatabasePath =  "modules" . DIRECTORY_SEPARATOR . "community" . DIRECTORY_SEPARATOR .
         * $module->getNameSpace() . DIRECTORY_SEPARATOR . 'database';
         *
         * $moduleMigrationPath = $moduleDatabasePath . DIRECTORY_SEPARATOR . 'migrations';
         *
         * $moduleSeedClass=  $moduleDatabasePath . DIRECTORY_SEPARATOR . 'seeds';
         *
         *
         *
         * try {
         *
         * ModuleModel::create([
         * 'type' => 'COMMUNITY',
         * 'identifier' => $identifier,
         * 'name' => $moduleName,
         * ]);
         *
         * Artisan::call('mage2:migrate',['--path' => $moduleMigrationPath]);
         * Artisan::call('mage2:dbseed', ['--path' => $moduleSeedClass]);
         * } catch (Exception $e) {
         * throw new Exception($e->getMessage());
         * }
         *
         * return redirect()->route('admin.module.index');
         */

    }


    /**
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function handleImageUpload($file)
    {
        // $file = $request->file('image'); or
        // $fileName = 'somename';
        $destinationPath = public_path('uploads/mage2/themes');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        return $destinationPath . DIRECTORY_SEPARATOR . $fileName;
    }

}
