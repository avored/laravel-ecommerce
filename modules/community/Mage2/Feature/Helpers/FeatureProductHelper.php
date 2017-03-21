<?php

namespace Mage2\Feature\Helpers;

use Mage2\Catalog\Models\ProductAttribute;
use Mage2\Catalog\Models\ProductVarcharValue;
use Illuminate\Support\Collection;
use Mage2\Catalog\Models\Product;


class FeatureProductHelper
{

    public function getFeaturedProducts()
    {
        $products = Collection::make([]);
        $attribute = ProductAttribute::where('identifier', '=', 'is_featured')->first();

        $attributeDropdownOption = $attribute->attributeDropdownOptions()->where('product_attribute_id','=', $attribute->id)->where('display_text','=','Yes')->first();

        $productIds = ProductVarcharValue::where('value','=', $attributeDropdownOption->id)->get()->pluck('product_id');

        foreach($productIds as $productId) {

            $product = Product::findorfail($productId);

            $products->push($product);
        }

        return $products;

    }
}
