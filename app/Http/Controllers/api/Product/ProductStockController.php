<?php

namespace App\Http\Controllers\api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductStockResource;
use App\Models\Product\Product;
use App\Models\Product\Stock;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        //$this->middleware('auth:vendor-api')->except(['index', 'show', 'addStock']);
        $this->productRepository = $productRepository;
    }

    public function index(Product $product)
    {
        $stocks = $product->stock;
        //$stocks->groupBy('address.postal_code');
        return $stocks;
        //add total quantity count
        // return ProductStockResource::collection($stocks);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //To add stock
    public function store(Product $product, Request $request)
    {
        try {
            $product = $this->productRepository->findOrFail($product->id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Product does not exist'], 404);
        }
        //need policy to check if vendor id is same as address vendor id
        $validatedData = $request->validate([
            'quantity' => ['required'],
            'address_id' => ['required'],
        ]);
        $prod_stock = Stock::make([
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
            'vendor_addresses_id'   => $request->address_id,
        ]);
        $prod_stock->save();
        $prod_stock->load('address');
        return (new ProductStockResource($prod_stock))
            ->additional(['message' => 'Success! Product stock saved.']);
        // return response()->json([
        //     'message' => 'Product stock added successfully.'
        // ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //need policy to check if vendor id is same as address vendor id
        $validatedData = $request->validate([
            'quantity' => ['required'],
            'address_id' => ['required'],
        ]);
        $stock->quantity = $request->quantity;
        $stock->vendor_addresses_id   = $request->address_id;
        $stock->save();
        return (new ProductStockResource($stock))
            ->additional(['message' => 'Success! Product stock saved.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return response()->json([
            'message' => 'Product Stock deleted!'
        ]);
    }
}
