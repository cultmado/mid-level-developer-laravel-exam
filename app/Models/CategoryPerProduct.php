<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryPerProduct extends Model
{
    use SoftDeletes;

    protected $table = 'category_per_product';

    protected $fillable = [
        'product_id',
        'productcategory_id'
    ];

    public function productCategory() {
        return $this->belongsTo(ProductCategory::class, 'productcategory_id', 'id')->withTrashed();
    }
}
