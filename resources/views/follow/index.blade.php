@extends('layouts.main')

@section('container')
    @include('partials.navbar')
    {{-- @include('partials.header') --}}

    <section id="follow-us">
        <div class="container text-center">
            <h6 class="section-title text-center mb-6"><a href="/#footer" class="text-decoration-none text-dark">Home</a> /
                Edit
                Follow Us</h6>
            <a href="" class="btn btn-primary font-weight-bold mb-4" data-bs-toggle="modal"
                data-bs-target="#addFollowUs">Add Platform</a>
            <div class="table-responsive table-hover">
                <table class='table table-bordered table-striped text-center text-uppercase'>
                    <thead class='thead-dark'>
                        <tr>
                            <th><center>No.</center></th>
                            <th>Platform</th>
                            <th>Account Name</th>
                            <th>Platform Link</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($follows as $follow)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><i class="{{ $follow->platform }}"></i></td>
                                <td>{{ $follow->name }}</td>
                                <td>{{ $follow->link }}</td>
                                <td>
                                    <div class="col d-flex justify-content-center">
                                        <a href="" class="btn btn-danger mr-1" style="background-color:#FF8882;"
                                            data-bs-toggle="modal" data-bs-target="#editPlatform{{ $follow->id }}"> <i
                                                class="ti-pencil-alt" data-bs-toggle="tooltip" data-bs-placement="left"
                                                data-bs-title="Edit platform"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deletePlatform{{ $follow->id }}">
                                            <i class="ti-trash" data-bs-toggle="tooltip" data-bs-placement="left"
                                                data-bs-title="Delete platform"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal edit platform --}}
                            <div class="modal fade" id="editPlatform{{ $follow->id }}" tabindex="-1"
                                aria-labelledby="editPlatformLabel{{ $follow->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editPlatformLabel{{ $follow->id }}">Edit
                                                Platform</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('follow-us.update', $follow->id) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="followId" value="{{ $follow->id }}">
                                            <div class="modal-body text-left">

                                                <div class="form-group mb-3">
                                                    <label><strong>Platform</strong></label>
                                                    <select name="platform" class="form-control" id="floatingSelect">
                                                        <option value="ti-facebook"
                                                            {{ $follow->platform == 'ti-facebook' ? 'selected' : '' }}>Facebook
                                                        </option>
                                                        <option value="ti-twitter-alt"
                                                            {{ $follow->platform == 'ti-twitter-alt' ? 'selected' : '' }}>Twitter
                                                        </option>
                                                        <option value="ti-rss"
                                                            {{ $follow->platform == 'ti-rss' ? 'selected' : '' }}>Blog</option>
                                                        <option value="ti-instagram"
                                                            {{ $follow->platform == 'ti-instagram' ? 'selected' : '' }}>Instagram
                                                        </option>
                                                        <option value="ti-youtube"
                                                            {{ $follow->platform == 'ti-youtube' ? 'selected' : '' }}>Youtube
                                                        </option>
                                                        <option value="ti-email"
                                                            {{ $follow->platform == 'ti-email' ? 'selected' : '' }}>Email</option>
                                                    </select>
                                                </div>


                                                <div class="form-group mb-3">
                                                    <label><strong>Account Name</strong></label>
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror rounded-top"
                                                        placeholder="Insert account name" autofocus id="name"
                                                        value="{{ old('name', $follow->name) }}" required>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label><strong>Platform Link</strong></label>
                                                    <input type="text" name="link"
                                                        class="form-control @error('link') is-invalid @enderror rounded-top"
                                                        placeholder="Insert link" id="link"
                                                        value="{{ old('link', $follow->link) }}" required>
                                                    @error('link')
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
                            {{-- End Modal edit platform --}}

                            {{-- Modal Delete Confirmation --}}
                            <div class="modal fade" id="deletePlatform{{ $follow->id }}" tabindex="-1"
                                aria-labelledby="deletePlatformLabel{{ $follow->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deletePlatformLabel{{ $follow->id }}">Delete
                                                Confirmation
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure want to delete this platform?
                                        </div>
                                        <div class="modal-footer">

                                            {{-- <form action="/gallery/{{ $gallery->id }}" method="post"> --}}
                                            <form action="{{ route('follow-us.destroy', $follow->id) }}" method="post">
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
            </div>
        </div>
    </section>

    {{-- Modal add follow us --}}
    <div class="modal fade" id="addFollowUs" tabindex="-1" aria-labelledby="tambahModalCategoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahModalCategoryLabel">Add New Platform</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('follow-us.store') }}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label><strong>Platform</strong></label>
                            <select name="platform" class="form-control" id="floatingSelect">
                                <option value="ti-facebook" selected>Facebook</option>
                                <option value="ti-twitter-alt">Twitter</option>
                                <option value="ti-rss">Blog</option>
                                <option value="ti-instagram">Instagram</option>
                                <option value="ti-youtube">Youtube</option>
                                <option value="ti-email">Email</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label><strong>Account Name</strong></label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror rounded-top"
                                placeholder="Insert account name" autofocus id="name" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label><strong>Platform Link</strong></label>
                            <input type="text" name="link"
                                class="form-control @error('link') is-invalid @enderror rounded-top"
                                placeholder="Insert link" id="link" value="{{ old('link') }}" required>
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal add follow us --}}
@endsection
