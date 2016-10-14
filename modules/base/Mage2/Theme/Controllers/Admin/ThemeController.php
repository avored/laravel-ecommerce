<?php

namespace Mage2\Theme\Controllers\Admin;

use Mage2\Framework\Theme\Facade\Theme as ThemeFacade;
use Mage2\Framework\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{

    public function __construct(){
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $themes = ThemeFacade::all();
        
        return view('admin.theme.index')->with('themes', $themes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.theme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Mage2\Framework\Http\Request $request
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Theme = Theme::findorfail($id);
        return view('tax-class.edit')
                    ->with('Theme', $Theme)
                    ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ThemeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThemeRequest $request, $id)
    {
       
        $Theme = Theme::findorfail($id);
        $Theme->update($request->all());

        return redirect()->route('admin.tax-class.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Theme::destroy($id);

        return redirect()->route('admin.tax-class.index');
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
