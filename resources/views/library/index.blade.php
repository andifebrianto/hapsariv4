@extends('layouts.main')

@section('container')
    @include('partials.navbar')
    @include('partials.header')

    <!-- edit image Section -->
    <section id="libraryThumbnail">
        <div class="container text-center">
            <h6 class="section-title text-center mb-6"><a href="/#library" class="text-decoration-none text-dark">Home</a> /
                Edit
                Image</h6>
            <div class="row align-items-center d-flex justify-content-center">

                <div class="col-md-5 col-lg-4 image-container ">
                    <a href="" data-bs-toggle="modal" data-bs-target="#pickImage">
                        <img src="library_thumbnails/{{ $library_thumb[0]->name }}" alt="about-us-image" class="w-100 img-thumbnail mb-3"
                            style="border:5px solid; border-radius:0.5rem; border-color:black" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-title="Edit image"></a>
                </div>
            </div>
        </div>
    </section>
    <!-- edit image Section -->

    {{-- Modal pick image --}}
    <div class="modal fade" id="pickImage" tabindex="-1" aria-labelledby="pickImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="pickImageLabel">Edit image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <h3>Choose Image</h3> --}}
                    <h5>Max: 20MB (jpg, jpeg, png)</h5>
                    <input type="file" name="image" class="image form-control" onchange="cropImage()">
                    <img class="img-preview img-fluid col-xl-5" id="frame">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal pick image --}}

    {{-- Modal crop image about --}}
    <div class="modal fade" id="cropImageAbout" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg-crop modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Please crop image for thumbnail
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" class="img-crop" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="crop">Crop and Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal crop image about --}}

    <!-- Category Section -->
    <section id="categories">
        <div class="overlay text-center p-3">
            <!-- <h6 class="section-subtitle text-center">Makes Happen</h6> -->
            {{-- <h5 class="section-subtitle text-center">LIBRARY</h5> --}}
            <h6 class="section-title text-center mb-6"><a href="/#library" class="text-decoration-none text-dark">Home</a> /
                Edit
                Category</h6>

            @if (session()->has('success'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- <div class="text-left mb-3">
                <h4><a href="/#library" class="text-decoration-none text-dark">Home</a> / Edit Category</h4>
            </div> --}}

            <div class="row mb-3">
                <div class="col-sm-4 col-md-3">
                    <div class="card mb-4">
                        <div class="card-body" style="background-color: #fff; border:0">
                            {{-- <button type="button" class="btn btn-primary w-lg" data-bs-toggle="modal"
                                data-bs-target="#tambahModalCategory">
                                Create New Category
                            </button> --}}
                            <a href="" data-bs-toggle="modal" data-bs-target="#tambahModalCategory"><img
                                    src="imgs/plus.png" alt="" width="70" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Add category"></a>
                        </div>
                    </div>
                </div>
                @foreach ($categories as $cat)
                    <div class="col-sm-4 col-md-3">
                        <div class="card mb-4">
                            <div class="card-body" style="background-color: #343a40">
                                {{-- <a class="text-decoration-none" href="/books?kategori={{ $cat->name }}#books"> --}}
                                {{-- <h2 class="mb-4" style="color: red;"><i class="fa-solid fa-{{ $cat->icon }}"></i>
                                    </h2> --}}

                                {{-- <p>{{ $cat->description }}</p>
                                </a> --}}
                                <h4 class="card-title text-white">{{ $cat->name }}</h4>
                                <div class="col">
                                    <button class="badge badge-secondary p-2" style="border: none" data-bs-toggle="modal"
                                        data-bs-target="#editModalCategory{{ $cat->id }}"><i class="ti-pencil-alt"
                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                            data-bs-title="Edit category"></i></button>
                                    <button class="badge badge-danger p-2" style="border: none" data-bs-toggle="modal"
                                        data-bs-target="#deleteModalCategory{{ $cat->id }}"><i class="ti-trash"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            data-bs-title="Delete category"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Edit Category --}}
                    <div class="modal fade" id="editModalCategory{{ $cat->id }}" tabindex="-1"
                        aria-labelledby="editModalCategoryLabel{{ $cat->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editModalCategoryLabel{{ $cat->id }}">Edit
                                        Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('library.update', $cat->id) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="categoryId" value="{{ $cat->id }}">
                                    <div class="modal-body text-left">
                                        <div class="form-group mb-3">
                                            <label><strong>Category Name</strong></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror rounded-top"
                                                placeholder="Insert name of new category" autofocus id="name"
                                                value="{{ old('name', $cat->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group mb-3">
                                            <label><strong>Description</strong></label><br><em>Max 255 characters</em>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Insert description of new category" required style="height: 100px">{{ old('description', $cat->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Edit Category --}}

                    {{-- Modal Delete Category Confirmation --}}
                    <div class="modal fade" id="deleteModalCategory{{ $cat->id }}" tabindex="-1"
                        aria-labelledby="deleteModalCategoryLabel{{ $cat->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalCategoryLabel{{ $cat->id }}">Delete
                                        Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure want to delete this category?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('library.destroy', $cat->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="categoryId" value="{{ $cat->id }}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Delete Category Confirmation --}}
                @endforeach

            </div>
            <a class="btn btn-secondary mt-6" href="/#library"><i class="fa-solid fa-circle-chevron-left"></i> Back to
                Home</a>
        </div>
    </section>
    <!-- End of Category Section -->

    {{-- Modal Add Category --}}
    <div class="modal fade" id="tambahModalCategory" tabindex="-1" aria-labelledby="tambahModalCategoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahModalCategoryLabel">Add New Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('library.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label><strong>Category Name</strong></label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror rounded-top"
                                placeholder="Insert name of new category" autofocus id="name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label><strong>Description</strong></label><br><em>Max 255 characters</em>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Insert description of new category" required style="height: 100px">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Add Category --}}

    <script>
        function cropImage() {
            frame.src = URL.createObjectURL(event.target.files[0]);
            var $modal = $('#cropImageAbout');
            var image = document.getElementById('image');
            var cropper;
            $("body").on("change", ".image", function(e) {
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };
                var reader;
                var file;
                var url;
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1 / 1,
                    viewMode: 0,
                    minCropBoxHeight: 501,
                    cropBoxResizable: false,
                    dragMode: 'move',
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });
            $("#crop").click(function() {
                canvas = cropper.getCroppedCanvas({
                    width: 1080,
                    height: 1079,
                });
                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "library-thumbnail",
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'image': base64data
                            },
                            success: function(data) {
                                console.log(data);
                                $modal.modal('hide');
                                // alert("Gambar berhasil diunggah");
                                window.location.reload();
                            },
                            error: (error) => {
                                console.log(JSON.stringify(error));
                            }
                        });
                    }
                });
            });
        }
    </script>
@endsection
