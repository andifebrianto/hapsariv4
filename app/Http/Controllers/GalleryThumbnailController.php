<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryThumbnail;

class GalleryThumbnailController extends Controller
{
    public function uploadCropGallery(Request $request)
    {
        $folderPath = public_path('gallery_thumbnails/');

        $image_parts = explode(";base64,", $request->name);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        $saveFile = new GalleryThumbnail;
        $saveFile->name = $imageName;
        $saveFile->save();

        return response()->json(['success' => 'Crop Gallery Uploaded Successfully']);
    }
}
