@extends('layouts.main')

@section('container')

    @include('partials.navbar')
    @include('partials.header')


    <!-- Page Header -->
    {{-- <header class="header">
        <div class="overlay">
            <h6 class="subtitle">LIBRARY</h6>
            <h1 class="title">HAPSARI</h1>
            <input type="searchbook" class="form-control" id="exampleFormControlInput1"
                placeholder="Search Book" style="width:55%; border-radius:50px;"></input>
            <button class="btn btn-primary rounded" style="margin-top: 10px;">Search</button>
        </div>
    </header> --}}
    <!-- End Of Page Header -->

    <!-- Library Section -->
    <section id="books">
        <div class="overlay text-center p-3">
            <!-- <h6 class="section-subtitle text-center">Makes Happen</h6> -->
            {{-- <h6 class="section-subtitle text-center">BOOKS</h6> --}}
            <h6 class="section-title text-center mb-3">{{ $header }}</h6>
            {{-- <a href="">
                <img src="imgs/plus.png" alt="" width="100" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Add folder or image">
            </a> --}}
            <a href="/books/create" class="btn btn-primary font-weight-bold mb-4">Add book</a>
            {{-- <a href="/books/create" class="btn btn-primary font-weight-bold mb-6">Tambah Buku</a> --}}
            @if (session()->has('success'))
                <div class="alert alert-success mb-6" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- cari buku --}}
            <form action="/books#books" method="get">
                <div class="input-group input-group-lg mb-3">
                    <label class="input-group-text" for="inputGroupSelect01"
                        style="height:50px; background-color:#be062a; color:#fff;"">Category</label>
                    <select name="kategori" class="form-select" id="inputGroupSelect01">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            @if ($header == $cat->name)
                                <option value="{{ $cat->name }}" selected>{{ $cat->name }}</option>
                            @else
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input name="cari" value="{{ request('cari') }}" type="text" class="form-control ml-3"
                        placeholder="Insert keyword.." autofocus style="height:50px;">
                    <button class="btn btn-primary" type="submit" style="height:50px;">Search</button>
                </div>
                {{-- <div class="input-group input-group-lg mb-4"> --}}
                {{-- @if (request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif --}}

                {{-- </div> --}}
            </form>
            {{-- end cari buku --}}

            <div class="row mb-3">
                @if ($books->count() > 0)
                    <div class="col-md-12">

                        {{-- <div class="page-header clearfix">
                        <h5 style="text-align: center;"><strong>{{ $header }}</strong></h5>
                    </div> --}}


                        <div class="table-responsive table-hover">
                            <table class='table table-bordered table-striped text-center text-uppercase'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>
                                            <center>No.</center>
                                        </th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th>Year</th>
                                        <th>Qty</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><a href="/books?kategori={{ $book->kategori }}#books"
                                                    class="text-decoration-none">{{ $book->kategori }}</a>
                                            </td>
                                            <td>{!! $book->judul !!}</td>
                                            <td>{!! $book->penulis !!}</td>
                                            {{-- <td>{{ $book->judul }}</td> --}}
                                            {{-- <td>{{ $book->penulis }}</td> --}}
                                            <td>{{ $book->penerbit }}</td>
                                            <td>{{ $book->tahun }}</td>
                                            <td>{{ $book->jumlah }}</td>
                                            <td>
                                                <div class="col d-flex justify-content-center">
                                                    <a href="books/{{ $book->id }}/edit" class="btn btn-danger mr-1"
                                                        style="background-color:#FF8882;" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" data-bs-title="Edit book"> <i
                                                            class="ti-pencil-alt"></i>
                                                    </a>
                                                    {{-- <form action="books/{{ $book->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge badge-danger border-0"
                                                        onClick="return confirm('Delete this databook ?')">Delete</button>
                                                </form> --}}
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $book->id }}">
                                                        <i class="ti-trash" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" data-bs-title="Delete book"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Modal Delete Confirmation --}}
                                        <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $book->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="deleteModalLabel{{ $book->id }}">Delete Confirmation
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure want to delete this book?
                                                    </div>
                                                    <div class="modal-footer">

                                                        {{-- <form action="/gallery/{{ $gallery->id }}" method="post"> --}}
                                                        <form action="{{ route('books.destroy', $book->id) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Modal Delete Confirmation --}}
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center pt-3 width-20px">
                                {{ $books->onEachSide(0)->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12 text-center">
                        <h4>BOOK NOT FOUND!</h4>
                    </div>
                @endif
            </div>
            {{-- <a class="btn btn-secondary mt-4" href="/library">Back to all categories page</a> --}}
            <a class="btn btn-secondary mt-6" href="/#library"><i class="fa-solid fa-circle-chevron-left"></i> Back to
                Home</a>
        </div>
    </section>
    <!-- End of Library Section -->

@endsection
