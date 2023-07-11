<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\FollowUs;
use App\Models\Gallery;
use App\Models\GalleryFolder;
use App\Models\User;
use Illuminate\Http\Request;

class GalleryFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('folder',[
            'folders' => GalleryFolder::latest()->get(),
            'galleries' => Gallery::all(),
            'about' => About::latest()->get(),
            'user' => User::first(),
            'follows' => FollowUs::all()
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
            'folder' => 'required|max:255'
        ]);

        GalleryFolder::create($validatedData);

        return redirect('/folder#folder')->with('success', 'New folder has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GalleryFolder  $galleryFolder
     * @return \Illuminate\Http\Response
     */
    public function show(GalleryFolder $galleryFolder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GalleryFolder  $galleryFolder
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryFolder $galleryFolder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GalleryFolder  $galleryFolder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryFolder $galleryFolder)
    {
        $validatedData = $request->validate([
            'folder' => 'required|max:255'
        ]);
        
        GalleryFolder::where('id', $request->folderId)
            ->update($validatedData);

        return redirect('/folder#folder')->with('success', 'Folder name has been modified');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryFolder  $galleryFolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryFolder $galleryFolder, Request $request)
    {
        if ($request->folderId == 1) {
            return redirect('/folder#folder')->with('failed', 'Folder uploads cant be deleted');
        }

        GalleryFolder::destroy($request->folderId);
        return redirect('/folder#folder')->with('success', 'Folder has been deleted');
    }
}
