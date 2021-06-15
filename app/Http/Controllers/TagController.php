<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'get data success',
            'data' => compact('tags'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tags = Tag::find($id);

        return response()->json([
            'success' => true,
            'message' => 'get data success',
            'data' => compact('tags'),
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
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();

        return response()->json([
            'success' => true,
            'message' => 'post data success',
            'data' => compact('tag'),
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
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->save();

        return response()->json([
            'success' => true,
            'message' => 'put/patch data success',
            'data' => compact('tag'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->product_tags()->delete();
        $tag->delete();

        return response()->json([
            'success' => true,
            'message' => 'get data success',
            'data' => null,
        ]);
    }
}
