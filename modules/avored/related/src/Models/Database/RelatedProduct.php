<?php
namespace AvoRed\Related\Models\Database;

use AvoRed\Framework\Models\Database\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class RelatedProduct extends Model
{
    protected $fillable = ['product_id','related_id'];


    /**
     *
     *
     *
     * @param integer $productId
     * @return \Illuminate\Database\Eloquent\Collection $relatedProducts
     */
    public function getRelatedProducts($productId)
    {
        $relateProductModels = $this->whereProductId($productId)->get();
        $relatedProducts = Collection::make([]);

        foreach ($relateProductModels as $relateProductModel) {
            $relatedProducts->push($relateProductModel->product);
        }

        return $relatedProducts;

    }


    public function product() {
        return $this->belongsTo(Product::class,'related_id');
    }

}
