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

    <!-- Activity Section -->
    <div class="container col-xxl-8 col-lg-8 py-5 p-3" >
        <div class="card bg-white p-4 shadow rounded-4 border-0">
            {{-- <h1>New {{ $kategori }}</h1>
            <p class="mb-4">
                <a href="/activity#activity" class="text-decoration-none text-dark">Activity</a> / Create {{ $kategori }}
            </p> --}}
            <p></p>
            <p></p>
            <p></p>
            <div class="section-header mb-6">
                <h2>Create new {{ $kategori }}</h2>
                <p>Please fill the form to add the {{ $kategori }}'s data</p>
            </div>

            <form action="/activity" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kategori" value="{{ $kategori }}">
                {{-- <input type="hidden" name="thumbnail_id" value="1"> --}}

                <div class="form-group mb-3">
                    <label><strong>{{ $kategori }} Title</strong></label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" required autofocus value="{{ old('judul') }}" placeholder="Input title">
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label><strong>{{ $kategori }} Description</strong></label>
                    <textarea name="info" class="form-control @error('info') is-invalid @enderror" style="height: 100px" required>{{ old('info') }}</textarea>
                    @error('info')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label><strong>{{ $kategori }} Image</strong></label><br><em>Max:20MB (jpg.jpeg,png)</em>
                    <div class="py-2">
                        <img class="img-preview" id="frame" width="300">
                    </div>
                    <input type="file" name="name" class="image form-control @error('name') is-invalid @enderror" onchange="cropImage()" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label><strong>{{ $kategori }} Body</strong></label>
                    <textarea name="desc" id="summernote" class="form-control @error('desc') is-invalid @enderror" required>{{ old('desc') }}</textarea>
                    @error('desc')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <a href="/activity?kategori={{ $kategori }}#activity" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
    <!-- End of Activity Section -->

    {{-- Modal crop activity --}}
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
                                <img id="image" class="img-crop" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal crop activity --}}

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
                            url: "../activity-thumbnail",
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
