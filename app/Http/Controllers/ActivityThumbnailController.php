<?php

namespace App\Http\Controllers;

use App\Models\ActivityThumbnail;
use Illuminate\Http\Request;

class ActivityThumbnailController extends Controller
{
    public function uploadCropActivity(Request $request)
    {
        $folderPath = public_path('activity_thumbnails/');

        $image_parts = explode(";base64,", $request->name);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        $saveFile = new ActivityThumbnail();
        $saveFile->name = $imageName;
        $saveFile->save();

        return response()->json(['success' => 'Crop Activity Uploaded Successfully']);
    }
}
