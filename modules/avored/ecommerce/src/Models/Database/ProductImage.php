<?php
namespace AvoRed\Ecommerce\Models\Database;

use AvoRed\Framework\Image\LocalFile;

class ProductImage extends BaseModel
{
    protected $fillable = ['product_id', 'path', 'is_main_image'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPathAttribute()
    {


        if (null === $this->attributes['path'] || empty($this->attributes['path'])) {
            return NULL;
        }
        $localImage = new LocalFile($this->attributes['path']);

        return $localImage;
    }


}
