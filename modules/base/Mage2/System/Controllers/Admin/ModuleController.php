<?php

namespace Mage2\System\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Framework\Theme\Facades\Theme;
use Mage2\Framework\Module\Facades\Module as ModuleFacade;
use Mage2\System\Models\Module as ModuleModel;

class ModuleController extends AdminController {

    /**
     * Display a listing of the theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $modelModule = new ModuleModel();
        $modules = ModuleFacade::all();

        return view('admin.module.index')
                        ->with('modules', $modules)
                        ->with('modelModule', $modelModule)
        //->with('activeTheme', $activeTheme)
        ;
    }

    /**
     * Show the form for creating a new theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.module.create');
    }

    /**
     * Store a newly created theme in database.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
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
     * @param string $identifier
     */
    public function install($identifier) {
       
        $module = ModuleFacade::get($identifier);
        
        
        $moduleName = $module->getName();
        $moduleDatabasePath =  "modules" . DIRECTORY_SEPARATOR . "community" . DIRECTORY_SEPARATOR . 
                        $module->getNameSpace() . DIRECTORY_SEPARATOR . 'database';
        
        $moduleMigrationPath = $moduleDatabasePath . DIRECTORY_SEPARATOR . 'migrations';
        
        $moduleSeedClass=  $moduleDatabasePath . DIRECTORY_SEPARATOR . 'seeds';
        
        
        
        try {
            /*
            ModuleModel::create([
                'type' => 'COMMUNITY',
                'identifier' => $identifier,
                'name' => $moduleName,
            ]);
             * 
             */
           
            //Artisan::call('mage2:migrate',['--path' => $moduleMigrationPath]);
            Artisan::call('mage2:dbseed', ['--path' => $moduleSeedClass]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.module.index');
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function handleImageUpload($file) {
        // $file = $request->file('image'); or
        // $fileName = 'somename';
        $destinationPath = public_path('uploads/mage2/themes');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        return $destinationPath . DIRECTORY_SEPARATOR . $fileName;
    }

}
