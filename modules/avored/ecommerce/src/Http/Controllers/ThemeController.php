<?php

namespace AvoRed\Ecommerce\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Theme\Facade as Theme;

class ThemeController extends Controller
{

    /**
     * Display a listing of the theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::all();
        $activeTheme = Configuration::getConfiguration('active_theme_identifier');

        return view('avored-ecommerce::theme.index')
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
        return view('avored-ecommerce::theme.create');
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
    public function activated($name)
    {
        $theme = Theme::get($name);

        try {
            $activeThemeConfiguration = Configuration::getConfiguration('active_theme_identifier');

            if (null !== $activeThemeConfiguration) {
                Configuration::setConfiguration('active_theme_identifier', $theme['name']);
            } else {
                Configuration::create([
                    'configuration_key' => 'active_theme_identifier',
                    'configuration_value' => $theme['name'],
                ]);
            }

            $activeThemePath = Configuration::getConfiguration('active_theme_path');
            if (null !== $activeThemePath) {
                Configuration::setConfiguration('active_theme_path', $theme['view_path']);
            } else {
                Configuration::create([
                    'configuration_key' => 'active_theme_path',
                    'configuration_value' => $theme['view_path'],
                ]);
            }

            $fromPath = $theme['asset_path'];
            $toPath = public_path('vendor/'.$theme['name']);

            //If Path Doesn't Exist it means its under development So no need to publish anything...
            if (File::isDirectory($fromPath)) {
                Theme::publishItem($fromPath, $toPath);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.theme.index');
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function deactivated($name)
    {
        if ('avored-default' === $name) {
            throw new Exception('You are not allowed to Deactivate AvoRed-Default Theme');
        }

        $theme = Theme::get('avored-default');

        try {
            $activeThemeConfiguration = Configuration::whereConfigurationKey('active_theme_identifier')->first();

            if (null !== $activeThemeConfiguration) {
                $activeThemeConfiguration->update(['configuration_value' => $theme['name']]);
            } else {
                Configuration::create([
                    'configuration_key' => 'active_theme_identifier',
                    'configuration_value' => $theme['name'],
                ]);
            }

            $activeThemePathConfiguration = Configuration::whereConfigurationKey('active_theme_path')->first();
            if (null !== $activeThemePathConfiguration) {
                $activeThemePathConfiguration->update(['configuration_value' => $theme['view_path']]);
            } else {
                Configuration::create([
                    'configuration_key' => 'active_theme_path',
                    'configuration_value' => $theme['name'],
                ]);
            }

            //Artisan::call('vendor:publish', ['--tag' => $name]);
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
        $destinationPath = public_path('uploads/avored/themes');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        return $destinationPath.DIRECTORY_SEPARATOR.$fileName;
    }
}
