<?php

namespace App\Http\Controllers\api\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Comment;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:cust-api']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        Comment::create([
            'customer_id'   =>  $request->user()->id,
            'product_id'    =>  $request->product_id,
            'comment'       =>  $request->comment
        ]);
        return
            response()->json(['success' => 'Comment Addded successfully'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        Comment::where('customer_id', $request->user()->id)
            ->where('product_id', $product->id)
            ->update([
                'comment'       =>  $request->comment
            ]);
        return
            response()->json(['success' => 'Comment Updated successfully'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Comment::where('customer_id', Auth::user()->id)
            ->where('product_id', $product->id)
            ->delete();
        return
            response()->json(['success' => 'Comment Deleted successfully'], 400);
    }
}
