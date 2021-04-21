<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product';

    protected $fillable = [
        'title',
        'content',
        'image'
    ];

    public function categoryPerProduct() {
        return $this->hasOne(CategoryPerProduct::class, 'product_id', 'id');
    }
}
