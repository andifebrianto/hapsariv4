@extends('layouts.main')

@section('container')
    @include('partials.navbar')
    @include('partials.header')

    <!-- Activity Section -->
    <section id="activity">
        <div class="overlay text-center p-3">

            <h6 class="section-title text-center mb-6">{{ $kategori }}</h6>
            <!-- <h6 class="section-title text-center mb-5" style="padding:40px";>
                        {{ $kategori == '' ? 'All Activity' : $kategori }}
                    </h6> -->
            <!-- <div class="dropdown mb-6">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Sort Activity
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="/activity#activity">All Activity</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="/activity?kategori=Article#activity">Article</a></li>
                          <li><a class="dropdown-item" href="/activity?kategori=Blog#activity">Blog</a></li>
                          <li><a class="dropdown-item" href="/activity?kategori=News#activity">News</a></li>
                        </ul>
                      </div> -->
            {{-- <a href="/activity/create?kategori={{ $kategori }}" class="btn btn-primary font-weight-bold mb-6">New
                {{ $kategori }}</a> --}}
            @if (session()->has('success'))
                <div class="alert alert-success mb-6" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                @auth
                    <div class="col-sm-3">
                        <div class="img-wrapper">
                            {{-- <a href="" data-bs-toggle="modal" data-bs-target="#addActivity" --}}
                            <a href="/activity/create?kategori=Article">
                                <img src="imgs/plus.png" alt="" width="100" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Add Article" style="width: 50%; vertical-align:center;"></a>
                        </div>
                    </div>
                @endauth

                @foreach ($activities as $item)
                    <div class="col-md-3 mb-6">
                        <div class="card blog-post my-4 my-sm-5 my-md-0">
                            <a href="" class="text-decoration-none text-dark" data-bs-toggle="modal"
                                data-bs-target="#activityDetail{{ $item->id }}">
                                <img src="{{ asset('activity_thumbnails/' . $item->thumbnails->name) }}" alt="">
                                <div class="card-body">
                                    <div class="details mb-3">
                                        {{-- <a href="javascript:void(0)"><i class="ti-comments"></i> 123</a> --}}
                                        <p>{{ $item->kategori }} / {{ $item->updated_at }}</p>
                                    </div>
                                    <h5 class="card-title">{{ $item->judul }}</h5>
                                    <p>{{ Str::limit($item->info, $limit = 100) }}</p>
                                    {{-- <a href="" class="d-block mt-3">Read More...</a> --}}
                                    <p style="color: red; text-decoration:underline">Read More...</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- Modal Show Activity --}}
                    <div class="modal fade" id="activityDetail{{ $item->id }}" tabindex="-1"
                        aria-labelledby="activityDetailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-body text-left">
                                    <h3 class="card-title mb-0 mt-3 text-center">{{ $item->judul }}</h3>
                                    <p class="mb-3 text-center">{{ $item->kategori }} / {{ $item->updated_at }}</p>
                                    <hr>
                                    <img src="{{ asset('storage/activities/' . $item->image) }}" class="img-fluid mb-6"
                                        alt="">
                                    {!! $item->desc !!}
                                </div>
                                <div class="modal-footer">

                                    @auth
                                        <a href="/activity/{{ $item->id }}/edit?kategori={{ $kategori }}"
                                            class="btn btn-primary">Edit</a>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#deleteActivity{{ $item->id }}">Delete</button>
                                    @endauth

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="modal fade" id="activityDetail{{ $item->id }}" tabindex="-1"
                        aria-labelledby="activityDetailLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-body text-left">
                                    <h3 class="card-title mb-0">{{ $item->judul }}</h3>
                                    <p class="mb-3">{{ $item->kategori }} / {{ $item->updated_at }}</p>
                                    <img src="{{ asset('storage/activities/' . $item->image) }}" class="img-fluid mb-5"
                                        alt="">
                                    {!! $item->desc !!}
                                </div>
                                <div class="modal-footer">
                                    <a href="/activity/{{ $item->id }}/edit?kategori={{ $kategori }}"
                                        class="btn btn-secondary">Edit</a>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#deleteActivity{{ $item->id }}">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- End Modal Show Activity --}}

                    {{-- Modal Delete activity Confirmation --}}
                    <div class="modal fade" id="deleteActivity{{ $item->id }}" tabindex="-1"
                        aria-labelledby="deleteActivityLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteActivityLabel{{ $item->id }}">Delete
                                        Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure want to delete this {{ $kategori }}?
                                </div>
                                <div class="modal-footer">

                                    <form action="{{ route('activity.destroy', $item->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="activityId" value="{{ $item->id }}">
                                        <input type="hidden" name="kategori" value="{{ $kategori }}">
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Delete activity Confirmation --}}
                @endforeach

            </div>
            {{-- <a class="btn btn-secondary mt-3" href="/activity">Go to Activity Page</a> --}}
            <a class="btn btn-secondary mt-6" href="/#article"><i class="fa-solid fa-circle-chevron-left"></i> Back to
                Home</a>
        </div>
    </section>
    <!-- End of Activity Section -->

    {{-- Modal add Activity --}}
    <div class="modal fade" id="addActivity" tabindex="-1" aria-labelledby="activityDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="activityDetailLabel">New Activity</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                    <a href="/activity/create?kategori=Article" class="btn btn-primary">
                        Add Article
                    </a>
                    <!-- <a href="/activity/create?kategori=Blog" class="btn btn-primary mx-2">
                                Add Blog
                            </a> -->
                    <a href="/activity/create?kategori=News" class="btn btn-primary">
                        Add News
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
@endsection
