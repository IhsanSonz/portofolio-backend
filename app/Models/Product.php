<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Moloquent;

class Product extends Moloquent
{
    use HasFactory;

    protected $collection = 'products';

    protected $fillable = [
        'name',
        'desc',
        'price',
        'user_id',
        'category_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product_dets()
    {
        return $this->hasMany(ProductDet::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product_tags()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
