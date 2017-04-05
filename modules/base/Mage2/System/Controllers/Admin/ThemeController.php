<?php

namespace Mage2\System\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Mage2\System\Models\Configuration;
use Mage2\Framework\System\Controllers\AdminController;
use Mage2\Framework\Theme\Facades\Theme;

class ThemeController extends AdminController
{
   

    /**
     * Display a listing of the theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = config('theme');
        $activeTheme = Configuration::getConfiguration('active_theme_identifier');

        return view('mage2system::admin.theme.index')
                        ->with('themes', $themes)
                        ->with('activeTheme', $activeTheme);
    }

    /**
     * Show the form for creating a new theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mage2system::admin.theme.create');
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
        $filePath = $this->handleImageUpload($request->file('theme_zip_file'));

        $zip = new \ZipArchive();


        if ($zip->open($filePath) === true) {
            $extractPath = base_path('themes');
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            throwException('Error in Zip Extract error.');
        }


        return redirect()->route('admin.theme.index');
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function activate($name)
    {
        $theme = Theme::get($name);
        try {
            Configuration::create([

                    'configuration_key'   => 'active_theme_identifier',
                    'configuration_value' => $name,
            ]);
            Configuration::create([
                'configuration_key'   => 'active_theme_path',
                'configuration_value' => $theme['path'],
            ]);
            Artisan::call('vendor:publish', ['--tag' => $name]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.theme.index');
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

        return $destinationPath.DIRECTORY_SEPARATOR.$fileName;
    }
}
