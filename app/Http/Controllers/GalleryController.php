<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryFolder;
use App\Models\GalleryThumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $folderId = $request->get('folderId');
        $nameFolder = GalleryFolder::firstWhere('id', $folderId);
        
        $galleries = Gallery::latest()->filter(request(['folderId']))->get();
        // dd($galleries);

        return view('gallery', [
            'folderId' => $folderId,
            'galleries' => $galleries,
            'nameFolder' => $nameFolder,
            'folders' => GalleryFolder::all(),
            // 'title' => 'gallery'
        ]);
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
        $validatedData = $request->validate([
            'name' => 'required|image|file|max:20480'
        ]);

        $thumb = GalleryThumbnail::latest()->first();
        $validatedData = [
            'thumbnail_id' => $thumb->id
        ];

        // $validatedData['thumbnail_id'] = 1;
        $folderId = $request->folderId;
        $validatedData['folder_id'] = $folderId;

        if ($request->file('name')) {
            $validatedData['name'] = $request->file('name')->store('galleries');
        }

        // dd($validatedData);
        Gallery::create($validatedData);

        return redirect('/gallery?folderId=' . $folderId . '#gallery')->with('success', 'Image has been uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validatedData = $request->validate([]);
        $validatedData['folder_id'] = $request->folder;

        Gallery::where('id', $request->galleryId)
            ->update($validatedData);

        return redirect('/folder#folder')->with('success', 'Image has been moved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, Request $request)
    {
        $folderId = $request->folderId;
        if($gallery->name){
            Storage::delete($gallery->name);
        }

        // Delete thumbnail
        // $thumb = GalleryThumbnail::latest('thumbnail_id')->first();
        $thumb_name = $gallery->thumbnails->name;
        if (!empty($thumb_name)) {
            $filePathDelete = public_path('gallery_thumbnails/' . $thumb_name);
            if (file_exists($filePathDelete)) {
                unlink($filePathDelete);
            }
        }

        Gallery::destroy($gallery->id);
        GalleryThumbnail::destroy($gallery->thumbnails->id);

        return redirect('/gallery?folderId=' . $folderId . '#gallery')->with('success', 'Image has been deleted');
    }
}
