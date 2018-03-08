<?php
namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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

        return view('avored-dashboard::module.index')
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
        return view('avored-dashboard::module.create');
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

            Artisan::call('avored:module:install', ['moduleidentifier' => $identifier]);
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
            Artisan::call('avored:module:uninstall', ['moduleidentifier' => $identifier]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.module.index');
    }


    /**
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function handleImageUpload($file)
    {
        // $file = $request->file('image'); or
        // $fileName = 'somename';
        $destinationPath = public_path('uploads/avored/themes');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        return $destinationPath . DIRECTORY_SEPARATOR . $fileName;
    }

}
