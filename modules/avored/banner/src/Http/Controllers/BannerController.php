<?php

namespace AvoRed\Banner\Http\Controllers;

use AvoRed\Banner\DataGrid\Banner as BannerGrid;
use App\Http\Controllers\Controller;
use AvoRed\Banner\Models\Database\Banner;
use AvoRed\Banner\Http\Requests\BannerRequest;
use AvoRed\Framework\Image\Facades\Image;
use AvoRed\Banner\Models\Contracts\BannerInterface;

class BannerController extends Controller
{
    /**
     *
     * @var \AvoRed\Banner\Models\Repository\BannerRepository;
     */
    protected $repository;

    public function __construct(BannerInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $bannerGrid = new BannerGrid($this->repository->query());

        return view('avored-banner::banner.index')->with('dataGrid', $bannerGrid->dataGrid);
    }

    public function create()
    {
        return view('avored-banner::banner.create');
    }

    public function store(BannerRequest $request)
    {
        $image = $request->file('image');

        $dbPath = $this->_uploadBanner($image);

        $request->merge(['image_path' => $dbPath]);
        $this->repository->create($request->all());

        return redirect()->route('admin.banner.index');
    }

    public function edit(Banner $banner)
    {
        return view('avored-banner::banner.edit')->with('model', $banner);
    }
    
    public function update(BannerRequest $request, Banner $banner)
    {
        $image = $request->get('image');
        
        if (null != $image) {
            $dbPath = $this->_uploadBanner($image);
            $request->merge(['image_path' => $dbPath]);
        }
        
        $banner->update($request->all());
        
        return redirect()->route('admin.banner.index');
    }

    public function show(Banner $banner)
    {
        return view('avored-banner::banner.show')->with('banner', $banner);
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banner.index');
    }

    private function _uploadBanner($image)
    {
        $tmpPath = str_split(strtolower(str_random(3)));
        $checkDirectory = '/uploads/cms/images/' . implode('/', $tmpPath);
        $localImage = Image::upload($image, $checkDirectory)->makeSizes()->get();

        $symblink = config('avored-framework.symlink_storage_folder'). "/";
        
        $relativePath = str_replace($symblink,'',$localImage->relativePath);
        return $relativePath;
    }
}
