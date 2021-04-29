<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Moloquent;

class ProductTag extends Moloquent
{
    use HasFactory;

    protected $collection = 'product_tags';

    protected $fillable = [
        'product_id',
        'tag_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'tag_id');
    }
}
