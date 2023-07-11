<!-- Page Header -->
<header class="header">
    <div class="overlay">
        <a class="navbar-brand text-center" href="#">
            <img class="p-5" width="75%" src="imgs/hapsari7.png" alt="">
        </a>
        @if (session()->has('success'))
            <div class="alert alert-success mb-3 d-flex justify-content-between" style="min-width: 40%" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="buttons text-center d-flex">

            @auth
                {{-- <a href="" class="btn btn-primary rounded w-lg btn-lg my-1" data-bs-toggle="modal"
                    data-bs-target="#dashboard">Welcome, {{ auth()->user()->name }}</a> --}}
                <a href="" class="btn btn-primary rounded w-lg btn-lg my-1" style="width: fit-content" data-bs-toggle="modal"
                    data-bs-target="#dashboard">Welcome, {{ Str::limit(auth()->user()->name, $limit = 10) }}</a>
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

{{-- Modal dashboard --}}
<div class="modal fade" id="dashboard" tabindex="-1" aria-labelledby="activityDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="activityDetailLabel">Dashboard</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <a href="/follow-us" class="btn btn-primary">
                    Edit follow us
                </a>
                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeProfile">
                    Change profile
                </a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal dashboard --}}

{{-- Modal change profile --}}
<div class="modal fade" id="changeProfile" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
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

                <form action="/profile-update" method="POST">
                    @csrf
                    <input type="hidden" name="userId" value="{{ $user->id }}">
                    <div class="mb-3">
                        <label for="name" class="form-label"><strong>New Name</strong></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="name@example.com" required
                            value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>New Email address</strong></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="name@example.com" required
                            value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="oldPassword" class="form-label"><strong>Old Password</strong></label>
                        <input type="password" name="oldPassword" class="form-control form-password"
                            id="oldPassword" placeholder="*************" required>
                        <input type="checkbox" class="form-checkbox mb-1"> Show Password
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><strong>New Password</strong></label>
                        <input type="password" name="password" class="form-control form-password" id="password"
                            placeholder="*************" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><strong>Confirm New Password</strong></label>
                        <input type="password" name="password2" class="form-control form-password" id="password2"
                            placeholder="*************" required>
                        {{-- <input type="checkbox" class="form-checkbox"> Show Password --}}
                    </div>

                    <div class="mb-6">
                        <button type="submit" class="btn btn-primary form-control"
                            style="width:100%; margin-top:20px;">Change username or password</button>
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
{{-- End Modal change profile --}}

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
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email address</strong></label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="name@example.com" required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label"><strong>Password</strong></label>
                        <input type="password" name="password" class="form-control form-password mb-1"
                            id="password" placeholder="*************" required>
                        <input type="checkbox" class="form-checkbox"> Show Password
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
