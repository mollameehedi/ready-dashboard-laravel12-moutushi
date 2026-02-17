@extends('admin.layouts.app')
@push('title', 'Social Media Link | Settings')
@push('settings', 'active')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Social Media Link</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title pb-2">Settings</h4>
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    @include('admin.pages.settings.sidebar')
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card border-top border-0 border-4 border-primary p-4">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-0 text-primary">Social Media Link</h4>
                </div>
            </div>
            <form action="{{ route('admin.settings.social_media.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="mt-3">Social Links</h5>
                            <hr>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="facebook_link" class="form-label">Facebook Link</label>
                                <input type="url" name="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" id="facebook_link" value="{{ setting('facebook_link') ?? old('facebook_link') }}">
                                @error('facebook_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="twitter_link" class="form-label">Twitter Link</label>
                                <input type="url" name="twitter_link" class="form-control @error('twitter_link') is-invalid @enderror" id="twitter_link" value="{{ setting('twitter_link') ?? old('twitter_link') }}">
                                @error('twitter_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="youtube_link" class="form-label">YouTube Link</label>
                                <input type="url" name="youtube_link" class="form-control @error('youtube_link') is-invalid @enderror" id="youtube_link" value="{{ setting('youtube_link') ?? old('youtube_link') }}">
                                @error('youtube_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="instagram_link" class="form-label">Instagram Link</label>
                                <input type="url" name="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror" id="instagram_link" value="{{ setting('instagram_link') ?? old('instagram_link') }}">
                                @error('instagram_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        {{-- ... (Your existing form fields for other settings) --}}

                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-primary rounded mt-3">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
