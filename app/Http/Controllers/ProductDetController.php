<?php

namespace App\Http\Controllers;

use App\Models\ProductDet;
use Illuminate\Http\Request;

class ProductDetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_dets = ProductDet::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'get data success',
            'data' => compact('product_dets'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_det = ProductDet::find($id);

        return response()->json([
            'success' => true,
            'message' => 'get data success',
            'data' => compact('product_det'),
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
        $product_det = new ProductDet;
        $product_det->color = $request->color;
        $product_det->size = $request->size;
        $product_det->stock = $request->stock;
        $product_det->photos = $request->photos;
        $product_det->save();

        return response()->json([
            'success' => true,
            'message' => 'post data success',
            'data' => compact('product_det'),
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
        $product_det = ProductDet::find($id);
        $product_det->color = $request->color;
        $product_det->size = $request->size;
        $product_det->stock = $request->stock;
        $product_det->photos = $request->photos;
        $product_det->save();

        return response()->json([
            'success' => true,
            'message' => 'put/patch data success',
            'data' => compact('product_det'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_det = ProductDet::find($id);
        $product_det->delete();

        return response()->json([
            'success' => true,
            'message' => 'delete data success',
            'data' => compact('product_det'),
        ]);
    }
}
