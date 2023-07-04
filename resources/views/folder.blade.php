@extends('layouts.main')

@section('container')
    @include('partials.navbar')
    @include('partials.header')

    <!-- folder Section -->
    <section id="folder">
        <div class="overlay text-center p-3">
            <!-- <h6 class="section-subtitle">Our Awesome Works</h6> -->
            {{-- <h6 class="section-title mb-3"><a href="/#gallery" class="text-decoration-none text-dark">Home</a> / Folder
            </h6> --}}
            <h6 class="section-title mb-3">Gallery</h6>
            {{-- <div class="col mb-6">
                <button class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#addImage">Upload Image</button>
            </div> --}}

            @if (session()->has('success'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger mb-3" role="alert">
                    {{ session('failed') }}
                </div>
            @endif

            <div class="row mb-3">
                @auth
                    <div class="col-sm-3 d-flex align-items-center">
                        <div class="img-wrapper">
                            <a href="" data-bs-toggle="modal" data-bs-target="#addFolderOrImage">
                                <img src="imgs/plus.png" alt="" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-title="Add folder or image" style="width: 50%; vertical-align:center;">
                            </a>
                        </div>
                    </div>
                @endauth

                @foreach ($folders as $folder)
                    <div class="col-sm-3">
                        <div class="img-wrapper">
                            <a href="/gallery?folderId={{ $folder->id }}#gallery">
                                <img src="imgs/folder.png" alt="">
                            </a>
                            <h5>{{ $folder->folder }}</h5>
                            @auth
                                <div class="overlay" style="background: rgba(0, 0, 0, 0);">
                                    <div class="overlay-infos">
                                        {{-- <h5>{{ $folder->folder }}</h5> --}}
                                        <a href="/gallery?folderId={{ $folder->id }}#gallery"><i class="ti-zoom-in "
                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                data-bs-title="Open folder"></i></a>

                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#editFolder{{ $folder->id }}"><i class="ti-pencil"
                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                data-bs-title="Edit folder"></i></a>
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#deleteFolder{{ $folder->id }}"><i class="ti-trash"
                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                data-bs-title="Delete folder"></i></a>
                                    </div>
                                </div>
                            @endauth

                        </div>
                    </div>

                    {{-- Modal Edit Folder --}}
                    <div class="modal fade" id="editFolder{{ $folder->id }}" tabindex="-1"
                        aria-labelledby="editFolderLabel{{ $folder->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editFolderLabel{{ $folder->id }}">Change
                                        folder name</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('folder.update', $folder->id) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="folderId" value="{{ $folder->id }}">
                                    <div class="modal-body text-left">
                                        <div class="form-group mb-3">
                                            <label><strong>Folder name</strong></label>
                                            <input type="text" name="folder"
                                                class="form-control @error('folder') is-invalid @enderror rounded-top"
                                                placeholder="Change name of new folder" autofocus id="folder"
                                                value="{{ old('folder', $folder->folder) }}" required>
                                            @error('folder')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                    {{-- End Modal Edit Folder --}}

                    {{-- Modal Delete Folder Confirmation --}}
                    <div class="modal fade" id="deleteFolder{{ $folder->id }}" tabindex="-1"
                        aria-labelledby="deleteFolderLabel{{ $folder->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteFolderLabel{{ $folder->id }}">Delete
                                        Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure want to delete this folder?
                                </div>
                                <div class="modal-footer">

                                    <form action="{{ route('folder.destroy', $folder->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="folderId" value="{{ $folder->id }}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Delete Folder Confirmation --}}
                @endforeach


            </div>
            <a class="btn btn-secondary mt-6" href="/#gallery"><i class="fa-solid fa-circle-chevron-left"></i> Back to
                Home</a>
        </div>
    </section>
    <!-- End of folder section -->

    {{-- Modal Add Folder --}}
    <div class="modal fade" id="addFolder" tabindex="-1" aria-labelledby="addFolderLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addFolderLabel">Create new folder</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('folder.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <label><strong>Folder name</strong></label>
                        <input type="text" name="folder"
                            class="form-control @error('folder') is-invalid @enderror rounded-top"
                            placeholder="Insert name of new folder" autofocus id="folder" value="{{ old('folder') }}"
                            required>
                        @error('folder')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Add Folder --}}

    {{-- Modal add image --}}
    <div class="modal fade" id="addImage" tabindex="-1" aria-labelledby="addImageLabel" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-hidden="true">
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
                        <input type="hidden" name="folderId" value="1">
                        <input type="file" name="name" class="image form-control" onchange="cropImage()">
                        <img class="img-preview img-fluid col-xl-5" id="frame">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal add image --}}

    {{-- Modal crop gallery --}}
    <div class="modal fade" id="cropImageAbout" tabindex="-1" role="dialog" aria-labelledby="cropImageAboutLabel"
        aria-hidden="true">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal crop gallery --}}

    {{-- Modal add Activity --}}
    <div class="modal fade" id="addFolderOrImage" tabindex="-1" aria-labelledby="activityDetailLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="activityDetailLabel">Add folder or image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex" style="justify-content:center">
                    <a href="" class="btn btn-primary mr-3" data-bs-toggle="modal" data-bs-target="#addFolder">
                        Add Folder
                    </a>
                    <!-- <a href="/activity/create?kategori=Blog" class="btn btn-primary mx-2">
                                                Add Blog
                                            </a> -->
                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addImage">
                        Add Image
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="">
                        Delete
                    </button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal add Activity --}}

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
