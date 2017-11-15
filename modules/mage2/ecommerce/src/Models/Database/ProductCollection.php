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
namespace Mage2\Ecommerce\Models\Database;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductCollection extends Collection
{

    /**
     * @var \Illuminate\Database\Eloquent\Collection
     *
     */
    protected $_collection = NULL;

    public function addCategoryFilter($categoryId)
    {

        $this->_collection = $this->_collection->filter(function ($product) use ($categoryId) {

            if ($product->categories->count() > 0 && $product->categories->pluck('id')->contains($categoryId)) {
                return $product;
            }
        });

        return $this;
    }

    public function addAttributeFilter($attributeId, $value)
    {


        $this->_collection = $this->_collection->filter(function ($product) use ($attributeId, $value) {

            foreach ($product->productAttributeValue as $productVarcharValue) {
                if ($productVarcharValue->attribute_id == $attributeId && $productVarcharValue->value == $value) {
                    return $product;
                }
            }
        });

        return $this;
    }


    public function paginateCollection($perPage = 10)
    {

        $request = request();
        $page = request('page');
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            $this->_collection->slice($offset, $perPage), // Only grab the items we need
            count($this->_collection), // Total items
            $perPage, // Items per page
            $page, // Current page
            ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url
        );


        $paginate = new LengthAwarePaginator($this->_collection, $perPage, $pageNumber);

        return $paginate;
    }

    public function setCollection($products)
    {
        $this->_collection = $products;
        return $this;
    }

}
