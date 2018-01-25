<?php
namespace Mage2\Ecommerce\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Mage2\Ecommerce\Models\Database\Category;
use Mage2\Ecommerce\Http\Requests\CategoryRequest;
use Mage2\Framework\System\Controllers\ApiController;

class CategoryController extends ApiController
{

    public function index()
    {
        $data = Category::all();
        return JsonResponse::create(['data' => $data,'status' => true]); ;
    }

    public function store(CategoryRequest $request)
    {
        $data = Category::create($request->all());
        return JsonResponse::create(['data' => $data,'status' => true],201); ;
    }

    public function show($id)
    {
        $data = Category::find($id);
        return JsonResponse::create(['data' => $data,'status' => true]); ;
    }


    public function update(CategoryRequest $request,$id)
    {
        $data = Category::find($id);
        $data->update($request->all());

        return JsonResponse::create(['data' => $data,'status' => true]); ;
    }

    public function destroy($id) {
        Category::destroy($id);

        return JsonResponse::create(null, 204); ;
    }
}
