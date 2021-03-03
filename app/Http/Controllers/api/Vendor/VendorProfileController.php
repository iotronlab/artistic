<?php

namespace App\Http\Controllers\api\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Vendor\VendorIndexResource;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class VendorProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor-api');
    }

    public function updateProfile(Request $request)
    {
        $vendor = $request->user();
        $input = $request->only(
            [
                'display_name',
                'contact_name',
                'url',
                'email',
                'contact',
                'bio',
            ]
        );
        // $input = $request->all();
        // $vendor = Vendor::findOrFail($user->id);
        $vendor->fill($input)->save();

        return response()->json([
            'message' => 'profile updated successfully. :)',
            'data'    => ['vendor' => $vendor]
        ], 200);
        // return new VendorIndexResource($vendor);
    }

    public function uploadImage(Request $request)
    {
        $vendor = $request->user();
        if (request()->file('profile')) {
            $image = request()->file('profile');
            //$image = request()->file('cover');
            $extension = $image->getClientOriginalExtension();
            //Filename to store
            $pic_path = $vendor->url . '-profile.' . $extension;
            //Upload Image
            $path = $image->storeAs('/profile-images/' . $vendor->url, $pic_path, 'public');
            $url = Storage::url($path);
            $web_url = asset($url);
            $vendor['avatarimg'] = $web_url;
            $vendor->save();
            return response()->json([
                'message' => 'image uploaded successfully. :)',
                'data'    => ['vendor' => $vendor]
            ], 200);
        } elseif (request()->file('cover')) {
            $image = request()->file('cover');
            $extension = $image->getClientOriginalExtension();
            //Filename to store
            $pic_path = $vendor->url . '-cover.' . $extension;
            //Upload Image
            $path = $image->storeAs('/profile-images/' . $vendor->url, $pic_path, 'public');
            $url = Storage::url($path);
            $web_url = asset($url);
            $vendor['coverimg'] = $web_url;
            $vendor->save();
            return response()->json([
                'message' => 'image uploaded successfully. :)',
                'data'    => ['vendor' => $vendor]
            ], 200);
        }
    }
}
