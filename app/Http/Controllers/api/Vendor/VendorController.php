<?php

namespace App\Http\Controllers\api\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryIndexResource;
use App\Http\Resources\Product\ProductIndexResource;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;

use App\Http\Resources\Vendor\VendorIndexResource;
use App\Http\Resources\Vendor\VendorResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::where('status', 0)->get();
        return VendorIndexResource::collection($vendors);
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
     * @param  \App\Models\Vendor\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {

        $productsPaginated = $vendor->products()->with(
            'images',
            'flat',
            'stock_addresses',
            'ordered_stocks',
        )->paginate();
        // $productsTransformed = $productsPaginated->getCollection()->groupBy(function ($item) {
        //     return $item->created_at->format('Y-m-d');
        // });
        // $productsPaginated->setCollection($productsTransformed);
        $vendor->increment('view_count', 1);
        //return new VendorResource($vendor);
        //return $vendor;
        return ProductIndexResource::collection($productsPaginated)->additional(['vendor' => new VendorIndexResource($vendor)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        // $image = request()->file('profile');
        // $image = request()->file('cover');
        // $extension = $image->getClientOriginalExtension();
        // //Filename to store
        // $pic_path = $vendor->slug . '.' . $extension;
        // //Upload Image
        // $path = $image->storeAs('/profile-images/' . $vendor . '/' . $vendor->sku, $pic_path, 'public');
        // $url = Storage::url($path);
        // $web_url = asset($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }

    public function uploadImage(Request $request)
    {
        // $image = request()->file('profile');
        // $image = request()->file('cover');
        // $extension = $image->getClientOriginalExtension();
        // //Filename to store
        // $pic_path = $vendor->slug . '.' . $extension;
        // //Upload Image
        // $path = $image->storeAs('/profile-images/' . $vendor . '/' . $vendor->sku, $pic_path, 'public');
        // $url = Storage::url($path);
        // $web_url = asset($url);

    }
    //To get featured artists
    public function featured()
    {
        $featured_artists = DB::table('featured_artists')->where('is_active', '1')->pluck('vendor_id');
        return VendorIndexResource::collection(Vendor::whereIn('id', $featured_artists)->get());
    }
}
