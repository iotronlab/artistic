<?php

namespace App\Http\Controllers\api\Category;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category\Category;

use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Http\Resources\Vendor\VendorIndexResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryIndexResource::collection(
            Category::with(
                'children',
                'children.children'
            )->parents()->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //Sort by popularities and then top 3 rows are fetched
        return response()->json([
            'products' => ProductIndexResource::Collection($category->products->sortByDesc('popularity')->splice(0, 3)),
            'artists'  => VendorIndexResource::collection($category->products->sortByDesc('vendor.popularity')->splice(0, 3))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
