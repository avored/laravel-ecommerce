<?php

namespace Mage2\Theme\Controllers\Admin;

use Mage2\Framework\Theme\Facade\Theme as ThemeFacade;
use Mage2\Framework\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mage2\Common\Models\Configuration;
use Mage2\Framework\Theme\Facade\Theme;

class ThemeController extends Controller
{

    public function __construct(){
        parent::__construct();
    }

    /**
     * Display a listing of the theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $themes = ThemeFacade::all();
        $activeTheme = Configuration::getConfiguration('active_theme_name');
        
        return view('admin.theme.index')
                    ->with('themes', $themes)
                    ->with('activeTheme', $activeTheme)
            ;
    }

    /**
     * Show the form for creating a new theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.theme.create');
    }

    /**
     * Store a newly created theme in database.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filePath = $this->handleImageUpload($request->file('theme_zip_file'));

        $zip = new \ZipArchive();


        if ($zip->open($filePath ) === TRUE) {
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
     *
     */
    public function activate($name){
        $theme = Theme::get($name);


        $this->publishes($theme['assets_folder'], public_path("vendor/" . $theme['name'] ),'public');

        //todo save into configuration
        dd($theme);
    }




    /**
     * @param \Illuminate\Http\UploadedFile $file
     *
     */
    public function handleImageUpload($file){
        // $file = $request->file('image'); or
        // $fileName = 'somename';
        $destinationPath = public_path('uploads/mage2/themes');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        return $destinationPath . DIRECTORY_SEPARATOR .$fileName;
    }
}
