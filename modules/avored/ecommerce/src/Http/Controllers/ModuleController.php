<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use AvoRed\Framework\Modules\Facade as Module;
use AvoRed\Ecommerce\Http\Requests\UploadModuleRequest;
use ZipArchive;

class ModuleController extends Controller
{
    /**
     * Display a listing of the modules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();

        return view('avored-ecommerce::module.index')
            ->with('modules', $modules);
    }

    /**
     * Display upload module forms
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-ecommerce::module.create');
    }

    /**
     * Store and Extract upload module zip files
     *
     * @param \AvoRed\Ecommerce\Http\Requests\UploadModuleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UploadModuleRequest $request)
    {
        $path = storage_path('app/' . $request->module_zip_file->store('public/uploads/modules'));

        $zip = new ZipArchive;

        if ($zip->open($path) === true) {
            $extractPath = base_path('modules');
            $zip->extractTo($extractPath);
            $zip->close();

            return redirect()->route('admin.module.index')
                        ->with('notificationText', 'Module Extracted successfully');
        } else {
            return redirect()
                    ->back()
                    ->with('errorNotificationText', 'There is some issue: Please check your permission and try again later!');
        }
    }
}
