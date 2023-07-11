<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\FollowUs;
use App\Models\LibraryThumbnail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $header = 'ALL CATEGORIES';
        // $pagination = 10;

        return view('library.index', [
            'title' => 'Categories',
            'header' => $header,
            'categories' => Category::latest()->get(),
            'about' => About::latest()->get(),
            'library_thumb' => LibraryThumbnail::latest()->get(),
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
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
            // 'description' => 'required|max:255|'
        ]);

        // $converted = Str::lower($request->name);
        // $validatedData['icon'] = $converted[0];

        Category::create($validatedData);

        return redirect('/library#categories')->with('success', 'New category has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // 'description' => 'required|max:255'
        ]);

        // $validatedData['icon'] = Str::lower($request->name)[0];
        // dd($validatedData);
        
        Category::where('id', $request->categoryId)
            ->update($validatedData);

        return redirect('/library#categories')->with('success', 'Category has been modified');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        Category::destroy($request->categoryId);
        return redirect('/library#categories')->with('success', 'Category has been deleted');
    }
}
