<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'get data success',
            'data' => compact('products'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return response()->json([
            'success' => true,
            'message' => 'get data success',
            'data' => compact('product'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;
        $product->save();

        $tags = $request->tags;
        foreach ($tags as $tag) {
            $tag_id = '';
            if (!$tag = Tag::where('name', $tag)->first()) {
                $newTag = new Tag;
                $newTag->name = $tag;
                $newTag->save();

                $tag_id = $newTag->_id;
            }

            $pivot = new ProductTag;
            $pivot->tag_id = $tag_id;
            $pivot->product_id = $product->_id;
            $pivot->save();
        }

        $product->refresh();
        $product->product_tags;

        return response()->json([
            'success' => true,
            'message' => 'post data success',
            'data' => compact('product'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'put/patch data success',
            'data' => compact('product'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->product_tags()->delete();
        $product->product_dets()->delete();
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'delete data success',
            'data' => compact('product'),
        ]);
    }
}
