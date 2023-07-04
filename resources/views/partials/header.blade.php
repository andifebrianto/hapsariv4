<!-- Page Header -->
<header class="header">
    <div class="overlay">
        <a class="navbar-brand text-center" href="#">
            <img class="p-5" width="75%" src="imgs/hapsari7.png" alt="">
        </a>
        <div class="buttons text-center d-flex">

            @auth
                <a href="" class="btn btn-primary rounded w-lg btn-lg my-1">Welcome, {{ auth()->user()->name }}</a>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-light rounded w-lg btn-lg my-1">Logout</button>
                </form>
            @else
                <a href="" class="btn btn-primary rounded w-lg btn-lg my-1 px-6" data-bs-toggle="modal"
                    data-bs-target="#login">Login</a>
                <!-- <a href="" class=" btn btn-outline-light rounded w-lg btn-lg my-1" data-bs-toggle="modal" data-bs-target="#followUs">Follow Us</a> -->
            @endauth

        </div>
    </div>
</header>
<!-- End Of PagHeader -->

{{-- Modal login --}}
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                {{-- <h1 class="modal-title fs-5 text-center mb-3" id="loginLabel"> LOGIN FORM</h1> --}}
                <div class="col d-flex justify-content-center">
                    <img src="imgs/hapsari.png" alt="" width="100">
                </div>

                @if (session()->has('loginError'))
                    <div class="alert alert-nger alert-dismissible fade show mb-3" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email address</strong></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label"><strong>Password</strong></label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="*************" required>
                    </div>

                    <div class="mb-6">
                        <button type="submit" class="btn btn-primary form-control"
                            style="width:100%; margin-top:20px;">Login</button>
                    </div>

                    <div class="mb-3">
                        <p class="mt-3">
                            Copyright
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; <a class="d-inline text-dark text-decoration-none"
                                href="">Hapsari</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Modal login --}}
