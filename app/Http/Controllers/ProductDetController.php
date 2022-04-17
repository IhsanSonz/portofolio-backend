<?php

namespace App\Http\Controllers;

use App\Models\ProductDet;
use File;
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
        $photos = [];

        foreach ($request->photos as $file) {
            $file_name = date('YmdHis') . "_" . $file->getClientOriginalName();
            $file_dir = 'storage/uploads/images';
            $file->move($file_dir, $file_name);

            array_push($photos, $file_name);
        }

        $product_det->photos = $photos;
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

        $photos = [];
        $file_dir = 'storage/uploads/images';

        foreach ($product_det->photos as $photo) {
            File::delete('storage/uploads/images/' . $photo);
        }

        foreach ($request->photos as $file) {
            $file_name = date('YmdHis') . "_" . $file->getClientOriginalName();
            $file->move($file_dir, $file_name);

            array_push($photos, $file_name);
        }

        $product_det->photos = $photos;
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
        $file_dir = 'storage/uploads/images/';

        $product_det = ProductDet::find($id);
        if (isset($product_det->photos) && !is_null($product_det->photos)) {
            if (is_array($product_det->photos)) {
                foreach ($product_det->photos as $photo) {
                    File::delete($file_dir . $photo);
                }
            } else {
                File::delete($file_dir . $product_det->photos);
            }
        };

        $product_det->delete();

        return response()->json([
            'success' => true,
            'message' => 'delete data success',
            'data' => null,
        ]);
    }
}
