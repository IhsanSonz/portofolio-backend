<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Moloquent;

class ProductDet extends Moloquent
{
    use HasFactory;

    protected $collection = 'product_dets';

    protected $fillable = [
        'size',
        'color',
        'stock',
        'ratings',
        'photos',
        'product_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
