<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutThumbnail;
use App\Models\Activity;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $randomGallery = Gallery::inRandomOrder()->take(12)->get();
        $randomArticle = Activity::where('kategori', 'Article')->inRandomOrder()->take(3)->get();
        $randomNews = Activity::where('kategori', 'News')->inRandomOrder()->take(3)->get();

        return view('home', [
            'about' => About::latest()->get(),
            'about_thumb' => AboutThumbnail::latest()->get(),
            'galleries' => $randomGallery,
            'categories' => Category::all(),
            'articles' => $randomArticle,
            'news' => $randomNews
        ]);
    }
}