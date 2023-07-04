@extends('layouts.main')

@section('container')
    @include('partials.navbar')
    @include('partials.header')

    <!-- Gallery Section -->
    <section id="gallery">
        <div class="overlay text-center p-3">
            <!-- <h6 class="section-subtitle">Our Awesome Works</h6> -->
            {{-- <h6 class="section-title mb-3"><a style="text-decoration: none; color:#343a40;" href="/gallery">Gallery</a></h6> --}}
            {{-- <h6 class="section-title mb-6"><a href="/#gallery" class="text-decoration-none text-dark">Home</a> / <a
                    href="/folder#folder" class="text-decoration-none text-dark">Folder</a> / {{ $nameFolder->folder }}
            </h6> --}}
            <h6 class="section-title mb-6"><a href="/folder#folder" class="text-decoration-none text-dark">Gallery</a> /
                {{ $nameFolder->folder }}
            </h6>
            {{-- <div class="col mb-6">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImage">Upload Image</button>
            </div> --}}
            @if (session()->has('success'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            {{-- <h6 class="section-title text-left mb-3">{{ $nameFolder->folder }}</h6> --}}
            <div class="row mb-3">
                @auth
                    <div class="col-sm-3 d-flex align-items-center">
                        <div class="img-wrapper">
                            <a href="" style="text-decoration: none; color:#343a40;" data-bs-toggle="modal"
                                data-bs-target="#addImage">
                                <img src="imgs/add-image.png" alt="" width="" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Add image" style="width: 50%; vertical-align:center;">
                                {{-- <h5>Add new image</h5> --}}
                            </a>
                        </div>
                    </div>
                @endauth

                @foreach ($galleries as $gallery)
                    <div class="col-sm-3">
                        <div class="img-wrapper">
                            <a href="" data-bs-toggle="modal" data-bs-target="#gambarModal{{ $gallery->id }}">
                                <img src="{{ asset('gallery_thumbnails/' . $gallery->thumbnails->name) }}" alt="">
                            </a>
                            {{-- <div class="overlay">
                                <div class="overlay-infos">
                                    <h5>Project Title</h5>
                                    <a href="" data-bs-toggle="modal"
                                        data-bs-target="#gambarModal{{ $gallery->id }}"><i class="ti-zoom-in"></i></a>
                                    <a href="" data-bs-toggle="modal"
                                        data-bs-target="#changeFolder{{ $gallery->id }}"><i class="ti-pencil"></i></a>
                                    <a href="" data-bs-toggle="modal"
                                        data-bs-target="#deleteImage{{ $gallery->id }}"><i class="ti-trash"></i></a>
                                </div>
                            </div> --}}
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

                                    @auth
                                        <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#changeFolder{{ $gallery->id }}">Move</a>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#deleteImage{{ $gallery->id }}">
                                            Delete
                                        </button>
                                    @endauth

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Show Image --}}

                    {{-- Modal Delete image Confirmation --}}
                    <div class="modal fade" id="deleteImage{{ $gallery->id }}" tabindex="-1"
                        aria-labelledby="deleteImageLabel{{ $gallery->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteImageLabel{{ $gallery->id }}">Delete
                                        Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure want to delete this image?
                                </div>
                                <div class="modal-footer">

                                    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="folderId" value="{{ $gallery->folder_id }}">
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Delete image Confirmation --}}

                    {{-- Modal change folder --}}
                    <div class="modal fade" id="changeFolder{{ $gallery->id }}" tabindex="-1" data-bs-keyboard="false"
                        aria-labelledby="changeFolderLabel{{ $gallery->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="changeFolderLabel{{ $gallery->id }}">Change folder
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('gallery.update', $gallery->id) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="galleryId" value="{{ $gallery->id }}">
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label><strong>Move to</strong></label>

                                            <select name="folder" class="form-control" id="floatingSelect">
                                                @foreach ($folders as $folder)
                                                    @if ($gallery->folder_id == $folder->id)
                                                        <option value="{{ $folder->id }}" selected>
                                                            {{ $folder->folder }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $folder->id }}">{{ $folder->folder }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            {{-- <label for="floatingSelect"><strong>KATEGORI</strong></label> --}}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Move</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal change folder --}}
                @endforeach


            </div>
            {{-- <a class="btn btn-secondary" href="/folder#folder">Back to folder Page</a> --}}
            <a class="btn btn-secondary mt-6" href="/folder#folder"><i class="fa-solid fa-circle-chevron-left"></i> Back
                to
                Folder</a>
        </div>
    </section>
    <!-- End of Gallery section -->

    {{-- Modal add image --}}
    <div class="modal fade" id="addImage" tabindex="-1" aria-labelledby="addImageLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addImageLabel">Add image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/gallery" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <h5>Max:20MB (jpg,jpeg,png)</h5>
                        <input type="hidden" name="folderId" value="{{ $folderId }}">
                        <input type="file" name="name" class="image form-control" onchange="cropImage()">
                        <img class="img-preview img-fluid col-xl-5" id="frame">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal add image --}}

    {{-- Modal crop gallery --}}
    <div class="modal fade" id="cropImageAbout" tabindex="-1" role="dialog" aria-labelledby="cropImageAboutLabel"
        aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg-crop modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropImageAboutLabel">Please crop image for thumbnail
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" class="img-crop"
                                    src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal crop gallery --}}

    <script>
        function cropImage() {
            frame.src = URL.createObjectURL(event.target.files[0]);
            var $modal = $('#cropImageAbout');
            var name = document.getElementById('name');
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
                    aspectRatio: 4 / 3,
                    viewMode: 0,
                    minCropBoxHeight: 150,
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
                    width: 664,
                    height: 500,
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
                            url: "gallery-thumbnail",
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'name': base64data
                            },
                            success: function(data) {
                                console.log(data);
                                $modal.modal('hide');
                                // alert("Gambar berhasil diunggah");
                                // window.location.reload();
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
