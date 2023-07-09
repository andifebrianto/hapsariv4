<?php

namespace App\Http\Controllers;

use App\Models\AboutThumbnail;
use App\Models\LibraryThumbnail;
use Illuminate\Http\Request;

class AboutThumbnailController extends Controller
{
    //uploadCropAbout
    public function uploadCropAbout(Request $request)
    {
        $folderPath = public_path('about_thumbnails/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.jpg';

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        // Delete old thumbnail
        $thumb = AboutThumbnail::latest('id')->first();
        if (!empty($thumb)) {
            $thumb->delete();
            $filePathDelete = public_path('about_thumbnails/' . $thumb->name);
            if (file_exists($filePathDelete)) {
                unlink($filePathDelete);
            }
        }

        // Add thumbnail
        $saveFile = new AboutThumbnail();
        $saveFile->name = $imageName;
        $saveFile->save();

        return response()->json(['success' => 'About Thumbnail Uploaded Successfully']);
        // return redirect('/#about')->with('success', 'About image has been modified');
    }

    //uploadCropAbout
    public function uploadCropLibrary(Request $request)
    {
        $folderPath = public_path('library_thumbnails/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.jpg';

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        // Delete old thumbnail
        $thumb = LibraryThumbnail::latest('id')->first();
        if (!empty($thumb)) {
            $thumb->delete();
            $filePathDelete = public_path('library_thumbnails/' . $thumb->name);
            if (file_exists($filePathDelete)) {
                unlink($filePathDelete);
            }
        }

        // Add thumbnail
        $saveFile = new LibraryThumbnail();
        $saveFile->name = $imageName;
        $saveFile->save();

        return response()->json(['success' => 'Library Thumbnail Uploaded Successfully']);
        // return redirect('/#about')->with('success', 'About image has been modified');
    }
}
