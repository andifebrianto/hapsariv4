@extends('layouts.main')

@section('container')
    @include('partials.navbar')

    <!-- Page Header -->
    {{-- <header class="header">
        <div class="overlay">
            <h6 class="subtitle">RUMAH SENI</h6>
            <h1 class="title">HAPSARI</h1>
            <div class="buttons text-center">
                <a href="/login" class="btn btn-primary rounded w-lg btn-lg my-1">Login</a>
                <a href="" class=" btn btn-outline-light rounded w-lg btn-lg my-1">Follow Us</a>
            </div>
        </div>
    </header> --}}
    <!-- End Of Page Header -->

    <!-- Library Section -->
    <section>
        <div class="overlay text-center" style="margin-left:15%; margin-right:15%">
            <div class="container-fluid">
                <div class="section-header mb-6">
                    <h2>Change Book Data</h2>
                    <p>Enter the required update</p>
                </div>
                <form action="/books/{{ $book->id }}" method="post">
                    @method('put')
                    @csrf

                    <div class="form-group mb-3">
                        <label><strong>Book Title</strong></label>
                        <input type="text" name="judul"
                            class="form-control @error('judul') is-invalid @enderror rounded-top" placeholder="Input title"
                            autofocus id="judul" value="{{ old('judul', $book->judul) }}" required>
                        {{-- <label for="judul"><strong>JUDUL</strong></label> --}}
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label><strong>Category</strong></label>

                        <select name="kategori" class="form-control" id="floatingSelect">
                            @foreach ($categories as $cat)
                                @if (old('kategori', $book->kategori) == $cat->name)
                                    <option value="{{ $cat->name }}" selected>{{ $cat->name }}</option>
                                @else
                                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        {{-- <label for="floatingSelect"><strong>KATEGORI</strong></label> --}}
                    </div>
                    <div class="form-group mb-3">
                        <label><strong>Author</strong></label><br><em>(If there are two or more author please press
                            ENTER)</em>
                        <textarea name="penulis" class="form-control @error('penulis') is-invalid @enderror" placeholder="Input author" required
                            id="floatingTextarea" style="height: 100px">{{ old('penulis', $book->penulis) }}</textarea>
                        {{-- <label for="floatingTextarea1"><strong>PENULIS</strong> (Jika 2 penulis atau lebih gunakan
                                enter)</label> --}}
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label><strong>Publisher</strong></label><br><em>(If there are two or more publisher please press
                            ENTER)</em>
                        <textarea name="penerbit" class="form-control @error('penerbit') is-invalid @enderror" placeholder="Input publisher"
                            required id="floatingTextarea2" style="height: 100px">{{ old('penerbit', $book->penerbit) }}</textarea>
                        {{-- <label for="floatingTextarea2"><strong>PENERBIT</strong> (Jika 2 penerbit atau lebih gunakan
                                enter)</label> --}}
                        @error('penerbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label><strong>Year</strong></label>
                        <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                            placeholder="Year" value="{{ old('tahun', $book->tahun) }}" required id="floatingTahun">
                        {{-- <label for="floatingTahun"><strong>TAHUN</strong></label> --}}
                        @error('tahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label><strong>Qty</strong></label>
                        <input type="number" value="{{ old('jumlah', $book->jumlah) }}" placeholder="Quantity"
                            name="jumlah" class="form-control @error('jumlah') is-invalid @enderror rounded-bottom"
                            required id="floatingJumlah">
                        {{-- <label for="floatingJumlah"><strong>JUMLAH</strong></label> --}}
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Update</button>
                    {{-- <input type="submit" class="btn btn-primary" value="Simpan"> --}}
                    <a href="/books#books" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </section>
    <!-- End of Library Section -->
@endsection
