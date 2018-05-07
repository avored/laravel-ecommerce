<?php

namespace AvoRed\Ecommerce\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use AvoRed\Ecommerce\DataGrid\Attribute;
use AvoRed\Framework\Repository\Product;
use AvoRed\Ecommerce\Http\Requests\AttributeRequest;

class AttributeController extends AdminController
{
    /**
     * AvoRed Product Repository.
     *
     * @var \AvoRed\Framework\Repository\Product
     */
    protected $productRepository;

    /**
     * ProductController constructor to Set AvoRed Attribute Repository Property.
     *
     * @param \AvoRed\Framework\Repository\Product $repository
     * @return void
     */
    public function __construct(Product $repository)
    {
        $this->productRepository = $repository;
    }

    public function index()
    {
        $attributeGrid = new Attribute(
                            $this->productRepository->attributeModel()->query()
                          );

        return view('avored-ecommerce::admin.attribute.index')->with('dataGrid', $attributeGrid->dataGrid);
    }

    public function create()
    {
        return view('avored-ecommerce::admin.attribute.create');
    }

    public function store(AttributeRequest $request)
    {
        $attribute = $this->productRepository->createAttribute($request->all());
        $this->_saveDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index');
    }

    public function edit($id)
    {
        $attribute = $this->productRepository->findAttributeById($id);

        return view('avored-ecommerce::admin.attribute.edit')->with('model', $attribute);
    }

    public function update(AttributeRequest $request, $id)
    {
        $attribute = $this->productRepository->findAttributeById($id);
        $attribute->update($request->all());

        $this->_saveDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->productRepository->destroyAttributeById($id);

        return redirect()->route('admin.attribute.index');
    }

    public function getAttribute(Request $request)
    {
        $attribute = $this->productRepository->findAttributeById($request->get('id'));

        return view('avored-ecommerce::admin.attribute.attribute-card-values')
            ->with('attribute', $attribute);
    }

    /**
     * Get the Element Html in Json Response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getElementHtml(Request $request)
    {
        $attributes = $this->productRepository->attributeModel()->whereIn('id', $request->get('attribute_id'))->get();

        $tmpString = '__RANDOM__STRING__';
        $view = view('avored-ecommerce::admin.attribute.get-element')
            ->with('attributes', $attributes)
            ->with('tmpString', $tmpString);

        return new JsonResponse(['success' => true, 'content' => $view->render()]);
    }

    /**
     * Save Attribute Drop down Options.
     *
     * @param \AvoRed\Framework\Models\Database\Attribute $attribute
     * @param \AvoRed\Ecommerce\Http\Requests\AttributeRequest $request
     * @return void
     */
    private function _saveDropdownOptions($attribute, $request)
    {
        if (null !== $request->get('dropdown-options')) {
            if (null != $attribute->attributeDropdownOptions()->get() && $attribute->attributeDropdownOptions()->get()->count() >= 0) {
                $attribute->attributeDropdownOptions()->delete();
            }
            foreach ($request->get('dropdown-options') as $key => $val) {
                if ($key == '__RANDOM_STRING__') {
                    continue;
                }

                $attribute->attributeDropdownOptions()->create($val);
            }
        }
    }
}
