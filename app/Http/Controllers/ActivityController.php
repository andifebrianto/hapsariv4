<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityThumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activities = Activity::latest()->filter(request(['kategori']))->get();

        return view('activity.index', [
            'activities' => $activities,
            'kategori' => $request->kategori
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('activity.create', [
            'kategori' => $request->kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'judul' => 'required',
            'info' => 'required',
            'name' => 'required|max:20000|mimes:jpg,jpeg,png',
            'desc' => 'required',
        ];

        $messages = [
            'judul.required' => 'Title must be filled!',
            'info.required' => 'Description must be filled!',
            'name.required' => 'Image must be filled!',
            'desc.required' => 'Body must be filled!',
        ];

        $this->validate($request, $rules, $messages);

        // Image
        $fileName = time() . '.' . $request->name->extension();
        $request->file('name')->storeAs('activities', $fileName);

        // Artikel
        $storage = "storage/content-activities";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filePath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)->encode($mimetype, 100)->save(public_path($filePath));
                $new_src = asset($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        $thumb = ActivityThumbnail::latest()->first();
        $kategori = $request->kategori;

        // $plainText = substr(strip_tags($dom->saveHTML()), 0, 50);
        // dd($plainText);

        Activity::create([
            'judul' => $request->judul,
            'thumbnail_id' => $thumb->id,
            'kategori' => $kategori,
            'info' => $request->info,
            'image' => $fileName,
            'desc' => $dom->saveHTML()
        ]);

        return redirect('/activity?kategori='. $kategori .'#activity')->with('success', 'New ' . $kategori . ' has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $activity = Activity::find($id);

        return view('activity.edit', [
            'kategori' => $request->kategori,
            'activity' => $activity
        ]);
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
        $activity = Activity::find($id);

        if ($request->hasFile('name')) {
            $fileCheck = 'required|max:20000|mimes:jpg,jpeg,png';
        } else {
            $fileCheck = 'max:20000|mimes:jpg,jpeg,png';
        }

        $rules = [
            'judul' => 'required',
            'info' => 'required',
            'name' => $fileCheck,
            'desc' => 'required',
        ];

        $messages = [
            'judul.required' => 'Title must be filled!',
            'info.required' => 'Description must be filled!',
            'name.required' => 'Image must be filled!',
            'desc.required' => 'Body must be filled!',
        ];

        $this->validate($request, $rules, $messages);

        // image
        if ($request->hasFile('name')) {
            // if (\File::exists('activities/' . $activity->image)) {
            //     \File::delete('activities/' . $activity->image);
            // }
            Storage::delete('activities/' . $activity->image);
            $fileName = time() . '.' . $request->name->extension();
            $request->file('name')->storeAs('activities', $fileName);

            // delete old thumbnail
            $thumb_name = $activity->thumbnails->name;
            if (!empty($thumb_name)) {
                $filePathDelete = public_path('activity_thumbnails/' . $thumb_name);
                if (file_exists($filePathDelete)) {
                    unlink($filePathDelete);
                }
            }
            ActivityThumbnail::destroy($activity->thumbnails->id);
            $thumb = ActivityThumbnail::latest()->first();
        } else {
            $thumb = $activity->thumbnails;
        }

        if ($request->hasFile('name')) {
            $checkFileName = $fileName;
        } else {
            $checkFileName = $activity->image;
        }

        // Artikel
        $storage = "storage/content-activities";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filePath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)->encode($mimetype, 100)->save(public_path($filePath));
                $new_src = asset($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        $kategori = $request->kategori;

        $activity->update([
            'judul' => $request->judul,
            'image' => $checkFileName,
            'desc' => $dom->saveHTML(),
            'thumbnail_id' => $thumb->id,
            'kategori' => $request->kategori,
            'info' => $request->info
        ]);

        return redirect('/activity?kategori='. $kategori .'#activity')->with('success', '' . $kategori . ' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $activity = Activity::find($id);
        Storage::delete('activities/' . $activity->image);

        Activity::whereId($id)->delete();

        // delete thumbnail
        $thumb_name = $activity->thumbnails->name;
        if (!empty($thumb_name)) {
            $filePathDelete = public_path('activity_thumbnails/' . $thumb_name);
            if (file_exists($filePathDelete)) {
                unlink($filePathDelete);
            }
        }

        $kategori = $request->kategori;
        ActivityThumbnail::destroy($activity->thumbnails->id);

        return redirect('/activity?kategori='. $kategori .'#activity')->with('success', '' . $kategori . ' has been deleted');

    }
}
