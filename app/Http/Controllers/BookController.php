<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Book;
use App\Models\Category;
use App\Models\FollowUs;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $header = 'All Categories';
        $pagination = 10;
        $keyword = $request->get('cari');

        // if (request('kategori')) {
        //     $book = Book::firstWhere('kategori', request('kategori'));
        //     $header =$book->kategori;
        // }

        if (request('kategori')) {
            $kategori = request('kategori');
            $book = Book::firstWhere('kategori', $kategori);
            if ($book) {
                $header = $book->kategori;
            } else {
                $header = $request->kategori;
            }
        }
        

        $books = Book::latest()->filter(request(['cari', 'kategori']))
        ->paginate(10)->fragment('books')->appends($request->except('page'));

        // highlight pencarian
        foreach ($books as $book)
        {
            $book->judul = str_replace($keyword, '<span class="highlight">'.$keyword.'</span>', $book->judul);
            $book->penulis = str_replace($keyword, '<span class="highlight">'.$keyword.'</span>', $book->penulis);
        }

        return view('books.index',[
            'title' => 'Books',
            'header' => $header,
            'categories' => Category::all(),
            'about' => About::latest()->get(),
            'books' => $books,
            'user' => User::first(),
            'follows' => FollowUs::all()
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create',[
            'title' => 'Create New Databook',
            'categories' => Category::all(),
            'about' => About::latest()->get(),
            'user' => User::first(),
            'follows' => FollowUs::all()
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
        $validatedData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required|max:255',
            'penulis' => 'max:255',
            'penerbit' => 'max:255',
            'tahun' => '',
            'jumlah' => ''
        ]);

        Book::create($validatedData);
        return redirect('/books#books')->with('success', 'Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit',[
            'title' => 'Edit Databook',
            'categories' => Category::all(),
            'book' => $book,
            'about' => About::latest()->get(),
            'user' => User::first(),
            'follows' => FollowUs::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required|max:255',
            'penulis' => 'max:255',
            'penerbit' => 'max:255',
            'tahun' => '',
            'jumlah' => ''
        ]);

        Book::where('id', $book->id)
            ->update($validatedData);

        return redirect('/books#books')->with('success', 'Updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        return redirect('/books#books')->with('success', 'Deleted successfully');
    }
}
