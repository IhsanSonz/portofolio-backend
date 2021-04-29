<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Moloquent;

class Tag extends Moloquent
{
    use HasFactory;

    protected $collection = 'tags';

    protected $fillable = ['name'];

    public function product_tags()
    {
        return $this->hasMany(ProductTag::class);
    }
}
