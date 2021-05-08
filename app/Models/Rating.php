<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Moloquent;

class Rating extends Moloquent
{
    use HasFactory;

    protected $collection = 'ratings';

    protected $fillable = [
        'rate',
        'user_id',
        'product_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
