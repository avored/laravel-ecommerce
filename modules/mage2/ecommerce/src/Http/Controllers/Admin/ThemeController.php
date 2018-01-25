<?php
namespace Mage2\Ecommerce\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Mage2\Ecommerce\Models\Database\Configuration;
use Mage2\Ecommerce\Theme\Facade as Theme;

class ThemeController extends AdminController
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

        return view('mage2-ecommerce::admin.theme.index')
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
        return view('mage2-dashboard::theme.create');
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

            if(null !== $activeThemeConfiguration) {
                Configuration::setConfiguration('active_theme_identifier',$theme['name']);
            } else {
                Configuration::create([
                    'configuration_key' => 'active_theme_identifier',
                    'configuration_value' => $theme['name'],
                ]);
            }

            $activeThemePath = Configuration::getConfiguration('active_theme_path');
            if(null !== $activeThemePath) {

                Configuration::setConfiguration('active_theme_path',$theme['view_path']);

            } else {
                Configuration::create([
                    'configuration_key' => 'active_theme_path',
                    'configuration_value' => $theme['view_path'],
                ]);
            }

            $fromPath = $theme['asset_path'];
            $toPath = public_path('vendor/'. $theme['name']);

            Theme::publishItem($fromPath, $toPath);

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
        if('mage2-default' === $name) {
            throw new Exception('You are not allowed to Deactivate Mage2-Default Theme');
        }

        $theme = Theme::get('mage2-default');

        try {
            $activeThemeConfiguration = Configuration::whereConfigurationKey('active_theme_identifier')->first();

            if(null !== $activeThemeConfiguration) {
                $activeThemeConfiguration->update(['configuration_value' => $theme['name']]);
            } else {
                Configuration::create([
                    'configuration_key' => 'active_theme_identifier',
                    'configuration_value' => $theme['name'],
                ]);
            }

            $activeThemePathConfiguration = Configuration::whereConfigurationKey('active_theme_path')->first();
            if(null !== $activeThemePathConfiguration) {
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
        $destinationPath = public_path('uploads/mage2/themes');
        $fileName = $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);

        return $destinationPath . DIRECTORY_SEPARATOR . $fileName;
    }

    protected function publishItem($from, $to)
    {
        if ($this->files->isDirectory($from)) {
            return $this->publishDirectory($from, $to);
        }

        $this->error("Can't locate path: <{$from}>");
    }

    /**
     * Publish the directory to the given directory.
     *
     * @param  string  $from
     * @param  string  $to
     * @return void
     */
    protected function publishDirectory($from, $to)
    {
        $this->moveManagedFiles(new MountManager([
            'from' => new Flysystem(new LocalAdapter($from)),
            'to' => new Flysystem(new LocalAdapter($to)),
        ]));

        //$this->status($from, $to, 'Directory');
    }


    /**
     * Move all the files in the given MountManager.
     *
     * @param  \League\Flysystem\MountManager  $manager
     * @return void
     */
    protected function moveManagedFiles($manager)
    {
        foreach ($manager->listContents('from://', true) as $file) {
            if ($file['type'] === 'file' && (! $manager->has('to://'.$file['path']))) {
                $manager->put('to://'.$file['path'], $manager->read('from://'.$file['path']));
            }
        }
    }

}
