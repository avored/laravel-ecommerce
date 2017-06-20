<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Category\Models;

use Mage2\Product\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Mage2\Framework\System\Models\BaseModel;
use Mage2\Catalog\Models\ProductVarcharValue;
use Mage2\Catalog\Models\ProductAttribute;


class Category extends BaseModel
{
    protected $fillable = ['parent_id', 'name', 'slug'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
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

        $rootCategories = $this->where('parent_id', '=', '0')->get();
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
        $productIds = $this->products->pluck('id');

        $productVarcharCollection = ProductVarcharValue::whereIn('product_id', $productIds)->get()->unique('product_attribute_id');

        foreach ($productVarcharCollection as $varcharValue) {
            $attrs->push(ProductAttribute::find($varcharValue->product_attribute_id));
        }
        return $attrs;

    }

    public function canShowFilters()
    {
        //dd($this);
        return true;
    }
}
