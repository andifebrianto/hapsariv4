@extends('layouts.main')

@section('container')
    @include('partials.navbar-home')
    @include('partials.header')

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row align-items-center p-3">

                <div class="col-md-5 col-lg-4 image-container ">
                    <img src="about_thumbnails/{{ $about_thumb[0]->name }}" alt="about-us-image"
                        class="w-100 img-thumbnail mb-3" style="border:5px solid; border-radius:0.5rem; border-color:black">
                    {{-- Edit picture about --}}
                    @auth
                        <a href="#" class="btn btn-primary button-overlay" data-bs-toggle="modal"
                            data-bs-target="#pickImage"><i class="ti-pencil-alt" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-title="Edit image"></i></a>

                    @endauth
                    {{-- Edit picture about end --}}
                </div>

                <div class="col-md-7 col-lg-8">
                    {{-- @if (session()->has('success'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif --}}
                    <h6 class="section-title mb-3">About Us
                        @auth
                            <a style="text-decoration: none; color:#343a40;" href="#about" data-bs-toggle="modal"
                                data-bs-target="#editAbout{{ $about[0]->id }}"><i class="ti-pencil-alt" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Edit description"></i></a>

                        @endauth
                    </h6>
                    <p>{!! $about[0]->description !!}</p>
                </div>

            </div>
        </div>
    </section>
    <!-- End of About Section -->

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

    {{-- Modal Edit About --}}
    <div class="modal fade" id="editAbout{{ $about[0]->id }}" tabindex="-1"
        aria-labelledby="editAboutLabel{{ $about[0]->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAboutLabel{{ $about[0]->id }}">Edit description</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('about.update', $about[0]->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="aboutId" value="{{ $about[0]->id }}">
                    <div class="modal-body">
                        <input id="description" type="hidden" name="description"
                            value="{{ old('description', $about[0]->description) }}">
                        <trix-editor input="description"></trix-editor>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Edit About --}}

    <!-- Gallery Section -->
    <section id="gallery">
        <div class="container text-center">
            <!-- <h6 class="section-subtitle">Our Awesome Works</h6> -->
            <h6 class="section-title mb-5"><a style="text-decoration: none; color:#343a40;"
                    href="/folder#folder">Gallery</a>
            </h6>

            <div class="row">
                @foreach ($galleries as $gallery)
                    <div class="col-sm-3">
                        <div class="img-wrapper"
                            style="border:5px solid; border-radius:0.5rem; border-color:black; padding:0.25rem">
                            <a href="" data-bs-toggle="modal" data-bs-target="#gambarModal{{ $gallery->id }}">
                                <img src="{{ asset('gallery_thumbnails/' . $gallery->thumbnails->name) }}" alt="">
                                <div class="overlay" style="background:rgba(0, 0, 0, 0.5);">
                                    <div class="overlay-infos">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- Modal Show Image --}}
                    <div class="modal fade" id="gambarModal{{ $gallery->id }}" tabindex="-1"
                        aria-labelledby="gambarModalLabel{{ $gallery->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <img src="{{ asset('storage/' . $gallery->name) }}" class="img-fluid"
                                        alt="Gambar {{ $gallery->id }}">
                                </div>
                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#deleteImage{{ $gallery->id }}">
                                        Delete
                                    </button> --}}
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Show Image --}}
                @endforeach
            </div>

            <!-- <a class="btn btn-secondary" href="/folder#folder">Go to Gallery Page</a> -->
            <a href="/folder#folder" class="btn btn-primary w-lg ml-3">More Photos..<i
                    class="fa-solid fa-circle-chevron-right"></i></a>
            {{-- <button class="btn btn-primary w-lg ml-3">More Photos..<i class="fa-solid fa-circle-chevron-right"></i></button> --}}
        </div>
    </section>
    <!-- End of Gallery section -->

    <!-- Library Section -->
    @auth
        <section id="library">
            <div class="container text-center">
                <div class="row align-items-center mb-3">
                    {{-- <div class="col-md-5 col-lg-4">
                        <img src="imgs/avatar-6.png" alt="" class="w-100 img-thumbnail mb-3"
                            style="border:5px solid; border-radius:0.5rem; border-color:black">
                    </div> --}}

                    <div class="col-md-5 col-lg-4 image-container ">
                        <img src="library_thumbnails/{{ $library_thumb[0]->name }}" alt="about-us-image"
                            class="w-100 img-thumbnail mb-3"
                            style="border:5px solid; border-radius:0.5rem; border-color:black">
                        {{-- Edit picture library --}}
                        @auth
                            <a href="/library#libraryThumbnail" class="btn btn-primary button-overlay"><i class="ti-pencil-alt" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-title="Edit image"></i></a>

                        @endauth
                        {{-- Edit picture library end --}}
                    </div>

                    <div class="col-md-7 col-lg-8">
                        <h6 class="section-title mb-3 ml-3 text-left">Library
                            @auth
                                <a style="text-decoration: none; color:#343a40;" href="/library#categories"><i
                                        class="ti-pencil-alt" data-bs-toggle="tooltip" data-bs-placement="right"
                                        data-bs-title="Edit categories"></i></a>
                            @endauth
                        </h6>
                        @foreach ($categories as $category)
                            <a href="/books?kategori={{ $category->name }}#books" class="btn btn-primary rounded mb-3"><i
                                    class="ti-book pr-1"></i>{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="/books#books" class="btn btn-primary w-lg mt-6">See All Books..<i
                        class="fa-solid fa-circle-chevron-right"></i></a>
            </div>
        </section>
    @endauth
    <!-- End of Library Section -->

    <!-- Article Section -->
    <section id="article">
        <div class="container text-center">
            <h6 class="section-title mb-6 text-center"><a style="text-decoration: none; color:#343a40;"
                    href="/activity?kategori=Article#activity">Article</a></h6>

            <div class="row">
                @foreach ($articles as $article)
                    <div class="col-md-4 mb-6">
                        <div class="card blog-post my-4 my-sm-5 my-md-0">
                            <a href="" class="text-decoration-none text-dark" data-bs-toggle="modal"
                                data-bs-target="#activityDetail{{ $article->id }}">
                                <img src="{{ asset('activity_thumbnails/' . $article->thumbnails->name) }}"
                                    alt=""
                                    style="border:3px solid; border-radius:0.5rem; border-color:black; padding:0.25rem">
                                <div class="card-body">
                                    <div class="details mb-3">
                                        {{-- <a href="javascript:void(0)"><i class="ti-comments"></i> 123</a> --}}
                                        <p>{{ $article->updated_at }}</p>
                                    </div>
                                    {{-- <h5 class="card-title">{{ $article->judul }}</h5> --}}
                                    <h5 class="card-title">{{ Str::limit($article->judul, $limit = 50) }}</h5>
                                    <p>{{ Str::limit($article->info, $limit = 100) }}</p>
                                    {{-- <a href="" class="d-block mt-3">Read More...</a> --}}
                                    <p style="color: red; text-decoration:underline">Read More...</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- Modal Show Article --}}
                    <div class="modal fade" id="activityDetail{{ $article->id }}" tabindex="-1"
                        aria-labelledby="activityDetailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-body text-left">
                                    <h3 class="card-title mb-0 mt-3 text-center">{{ $article->judul }}</h3>
                                    <p class="mb-3 text-center">{{ $article->updated_at }}</p>
                                    <hr>
                                    <img src="{{ asset('storage/activities/' . $article->image) }}"
                                        class="img-fluid mb-6" alt="">
                                    {!! $article->desc !!}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Show Article --}}
                @endforeach

            </div>
            <!-- <a class="btn btn-secondary mt-3" href="/activity?kategori=Article#activity">Go to Article Page</a> -->
            <a href="/activity?kategori=Article#activity" class="btn btn-primary w-lg ml-3">More Article.. <i
                    class="fa-solid fa-circle-chevron-right"></i></a>
            {{-- <button class="btn btn-primary w-lg ml-3">More Article.. <i class="fa-solid fa-circle-chevron-right"></i></button> --}}
        </div>
    </section>
    <!-- End of Article Section -->

    <!-- News Section -->
    <section id="news">
        <div class="container text-center">
            <h6 class="section-title mb-6 text-center"><a style="text-decoration: none; color:#343a40;"
                    href="/activity?kategori=News#activity">News</a></h6>

            <div class="row">
                @foreach ($news as $nw)
                    <div class="col-md-4 mb-6">
                        <div class="card blog-post my-4 my-sm-5 my-md-0">
                            <a href="" class="text-decoration-none text-dark" data-bs-toggle="modal"
                                data-bs-target="#newsDetail{{ $nw->id }}">
                                <img src="{{ asset('activity_thumbnails/' . $nw->thumbnails->name) }}" alt=""
                                    style="border:3px solid; border-radius:0.5rem; border-color:black; padding:0.25rem">
                                <div class="card-body">
                                    <div class="details mb-3">
                                        {{-- <a href="javascript:void(0)"><i class="ti-comments"></i> 123</a> --}}
                                        <p>{{ $nw->updated_at }}</p>
                                    </div>
                                    {{-- <h5 class="card-title">{{ $nw->judul }}</h5> --}}
                                    <h5 class="card-title">{{ Str::limit($nw->judul, $limit = 50) }}</h5>
                                    <p>{{ Str::limit($nw->info, $limit = 100) }}</p>
                                    {{-- <a href="" class="d-block mt-3">Read More...</a> --}}
                                    <p style="color: red; text-decoration:underline">Read More...</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- Modal Show News --}}
                    <div class="modal fade" id="newsDetail{{ $nw->id }}" tabindex="-1"
                        aria-labelledby="activityDetailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-body text-left">
                                    <h3 class="card-title mb-0 mt-3 text-center">{{ $nw->judul }}</h3>
                                    <p class="mb-3 text-center">{{ $nw->updated_at }}</p>
                                    <hr>
                                    <img src="{{ asset('storage/activities/' . $nw->image) }}" class="img-fluid mb-6"
                                        alt="">
                                    {!! $nw->desc !!}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Show News --}}
                @endforeach

            </div>
            <!-- <a class="btn btn-secondary mt-3" href="/activity?kategori=Article#activity">Go to Article Page</a> -->
            {{-- <button class="btn btn-primary w-lg ml-3">More News.. <i class="fa-solid fa-circle-chevron-right"></i></button> --}}
            <a href="/activity?kategori=News#activity" class="btn btn-primary w-lg ml-3">More News.. <i
                    class="fa-solid fa-circle-chevron-right"></i></a>
        </div>
    </section>
    <!-- End of News Section -->
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

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
                            url: "about-thumbnail",
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
