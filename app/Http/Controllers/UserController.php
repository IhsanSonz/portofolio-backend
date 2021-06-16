<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDet;
use App\Models\ProductTag;
use App\Models\Rating;
use App\Models\Tag;
use App\Models\User;

class UserController extends Controller
{
    public function truncate()
    {
        User::truncate();
        Category::truncate();
        Tag::truncate();
        Product::truncate();
        ProductDet::truncate();
        ProductTag::truncate();
        Rating::truncate();

        return 'finished';
    }
}
