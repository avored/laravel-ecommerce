<?php
namespace Mage2\Ecommerce\Models\Database;

use Illuminate\Support\Collection;


class Category extends BaseModel
{
    protected $fillable = ['parent_id', 'name', 'slug','meta_title','meta_description'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public static function getCategoryOptions() {

        $model = new static;
        $options = Collection::make(['' => 'Please Select'] + $model->all()->pluck('name', 'id')->toArray());

        return $options;
    }

    public function getParentNameAttribute()
    {
        $parentCategory = $this->where('id', '=', $this->attributes['parent_id'])->get()->first();

        return (null != $parentCategory) ? $parentCategory->name : '';
    }

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getAllCategories()
    {
        $data = [];

        $rootCategories = $this->where('parent_id', '=', null)->orWhere('parent_id','=','0')->get();
        $data = $this->list_categories($rootCategories);

        return $data;
    }

    public function list_categories($categories)
    {
        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'object' => $category,
                'children' => $this->list_categories($category->children),
            ];
        }

        return $data;
    }

    public function getChilds($id)
    {
        return $this->where('parent_id', '=', $id)->get();
    }


    public function getFilters()
    {
        $attrs = Collection::make([]);

        $productIds = Collection::make([]);
        $products = $this->products;



        foreach ($products as $product) {
            foreach ($product->productVariations as $variation) {
                //dd($variation);
                $productIds->push($variation->variation_id);
            }
            $productIds->push($product->id);
        }


        $collections = ProductAttributeBooleanValue::whereIn('product_id', $productIds)->get()->unique('attribute_id');
            foreach ($collections as $booleanValue) {
                $attrs->push(Attribute::find($booleanValue->attribute_id));
            }
        //}

        $collections = ProductAttributeDatetimeValue::whereIn('product_id', $productIds)->get()->unique('attribute_id');
            foreach ($collections as $booleanValue) {
                $attrs->push(Attribute::find($booleanValue->attribute_id));
            }
        //}

        $collections = ProductAttributeDecimalValue::whereIn('product_id', $productIds)->get()->unique('attribute_id');
            foreach ($collections as $booleanValue) {
                $attrs->push(Attribute::find($booleanValue->attribute_id));
            }
        //}

        $collections = ProductAttributeIntegerValue::whereIn('product_id', $productIds)->get()->unique('attribute_id');

            foreach ($collections as $booleanValue) {
                $attrs->push(Attribute::find($booleanValue->attribute_id));
            }
        //}

        $collections = ProductAttributeTextValue::whereIn('product_id', $productIds)->get()->unique('attribute_id');
            foreach ($collections as $booleanValue) {
                $attrs->push(Attribute::find($booleanValue->attribute_id));
            }
        //}

        $collections = ProductAttributeVarcharValue::whereIn('product_id', $productIds)->get()->unique('attribute_id');
            foreach ($collections as $booleanValue) {
                $attrs->push(Attribute::find($booleanValue->attribute_id));
            }
        //}




        return $attrs;

    }
}
