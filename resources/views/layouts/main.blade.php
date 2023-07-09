<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Rumah Seni Hapsari">
    <meta name="author" content="IT 2022">
    <title>Rumah Seni Hapsari</title>

    {{-- CSRF token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- font icons -->
    <link rel="stylesheet" href="{{ URL::asset('/') }}vendors/themify-icons/css/themify-icons.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    <!-- Bootstrap + Creative Studio main styles -->
    <link rel="stylesheet" href="{{ URL::asset('/') }}css/creative-studio.css">

    {{-- css online --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> --}}

    {{-- Trix css --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>

    {{-- Cropper css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />

    <!-- include summernote css -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    @yield('container')

    <section class="has-bg-img py-0">
        <div class="container">
            <div class="footer">
                <div class="footer-lists">
                    <ul class="list">
                        <li class="list-body">
                            <a href="#" class="">
                                <img src="{{ asset('imgs/hapsari7.png') }}" alt="" width="100%">
                            </a>
                        </li>
                    </ul>
                    <ul class="list">
                        <li class="list-head">
                            <h6 class="font-weight-bold">ABOUT US</h6>
                        </li>
                        <li class="list-body">
                            {{-- <a href="#" class="logo">
                                <img src="{{ asset('imgs/hapsari.jpeg') }}" alt="">
                                <h6>Rumah Seni Hapsari</h6>
                            </a> --}}
                            {{-- <p>{!! $about[0]->description !!}</p> --}}
                            <p>{!! Str::limit($about[0]->description, $limit = 150) !!}</p>
                            <p class="mt-3">
                                Copyright
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> &copy; <a class="d-inline text-primary"
                                    href="">Hapsari</a>
                            </p>
                        </li>
                    </ul>
                    <ul class="list">
                        <li class="list-head">
                            <h6 class="font-weight-bold">USEFUL LINKS</h6>
                        </li>
                        <li class="list-body">
                            <div class="row">
                                <div class="col">
                                    <a href="/">About</a>
                                    <a href="/folder">Gallery</a>
                                    <a href="/books">Library</a>
                                </div>
                                <div class="col">
                                    <a href="/activity?kategori=Article">Article</a>
                                    <a href="/activity?kategori=News">News</a>
                                    <a href="">Blog</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list">
                        <li class="list-head">
                            <h6 class="font-weight-bold">FOLLOW US
                                {{-- add and edit follow us --}}
                                @auth
                                    <a style="text-decoration: none; color:#fff;" href="/follow-us"><i class="ti-pencil-alt" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="Edit follow us"></i></a>

                                @endauth
                                {{-- add and edit follow us end --}}
                            </h6>
                        </li>
                        <li class="list-body">
                            <div class="row">
                                @foreach ($follows as $follow)
                                    <a href="{{ $follow->link }}" class="link"><i class="{{ $follow->platform }}"></i>
                                        {{ $follow->name }}</a>
                                @endforeach
                                {{-- <div class="col">
                                    <a href="" class="link"><i class="ti-facebook"></i> Facebook</a>
                                    <a href="" class="link"><i class="ti-twitter-alt"></i> Twitter</a>
                                    <a href="https://rumahsenihapsari56.blogspot.com/" class="link"><i
                                            class="ti-rss"></i> Blog</a>
                                </div>
                                <div class="col">
                                    <a href="" class="link"><i class="ti-instagram"></i> Instagram</a>
                                    <a href="" class="link"><i class="ti-youtube"></i> Youtube</a>

                                </div> --}}
                            </div>
                        </li>
                        {{-- <div class="social-links col">
                            <a href="javascript:void(0)" class="link"><i class="ti-facebook"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-twitter-alt"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-google"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-pinterest-alt"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-instagram"></i></a>
                            <a href="javascript:void(0)" class="link"><i class="ti-rss"></i></a>
                        </div> --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- core -->
    <script src="{{ URL::asset('/') }}vendors/jquery/jquery-3.4.1.js"></script>
    <script src="{{ URL::asset('/') }}vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap affix -->
    <script src="{{ URL::asset('/') }}vendors/bootstrap/bootstrap.affix.js"></script>
    <script src="https://kit.fontawesome.com/49f91fcdd3.js" crossorigin="anonymous"></script>

    <!-- Creative Studio js -->
    <script src="{{ URL::asset('/') }}js/creative-studio.js"></script>

    {{-- Trix js --}}
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    {{-- Popperjs --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    {{-- Cropperjs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

    <!-- include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>

    {{-- Summernote js --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 500,
            });
        });
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>
