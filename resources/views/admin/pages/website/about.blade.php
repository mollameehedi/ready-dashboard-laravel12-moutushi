@extends('admin.layouts.app')
@push('title', 'About Page | Settings')
@push('settings', 'active')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">About Page</li>
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
                    @include('admin.pages.website.sidebar')
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card border-top border-0 border-4 border-primary p-4">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-0 text-primary">About Page Information</h4>
                </div>
            </div>
            <form action="{{ route('admin.settings.website.about.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>About Information</h5>
                            <hr>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="about_title" class="form-label">About Title</label>
                                <input type="text" name="about_title" class="form-control @error('about_title') is-invalid @enderror" id="about_title" value="{{ setting('about_title') ?? old('about_title') }}">
                                @error('about_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="about_description" class="form-label">About Description</label>
                                <textarea name="about_description" id="about_description" class="form-control @error('about_description') is-invalid @enderror" rows="3">{{ setting('about_description') ?? old('about_description') }}</textarea>
                                @error('about_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="about_img" class="form-label">About Image</label>
                                <input type="file" name="about_img" class="form-control @error('about_img') is-invalid @enderror" id="about_img">
                                @if( setting('about_img'))
                                    <img src="{{ setting_img('about_img') }}" alt="About Image" width="100">
                                @endif
                                @error('about_img')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h5 class="mt-3">Vission Information</h5>
                            <hr>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="vission_title" class="form-label">Vision Title</label>
                                <input type="text" name="vission_title" class="form-control @error('vission_title') is-invalid @enderror" id="vission_title" value="{{ setting('vission_title') ?? old('vission_title') }}">
                                @error('vission_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="vission_description" class="form-label">Vision Description</label>
                                <textarea name="vission_description" id="vission_description" class="form-control @error('vission_description') is-invalid @enderror" rows="3">{{ setting('vission_description') ?? old('vission_description') }}</textarea>
                                @error('vission_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="vission_img" class="form-label">Vision Image</label>
                                <input type="file" name="vission_img" class="form-control @error('vission_img') is-invalid @enderror" id="vission_img">
                                @if( setting_img('vission_img') )
                                    <img src="{{ setting_img('vission_img') }}" alt="Vision Image" width="100">
                                @endif
                                @error('vission_img')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h5 class="mt-3">Mission Information</h5>
                            <hr>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="mission_title" class="form-label">Mission Title</label>
                                <input type="text" name="mission_title" class="form-control @error('mission_title') is-invalid @enderror" id="mission_title" value="{{ setting('mission_title') ?? old('mission_title') }}">
                                @error('mission_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="mission_description" class="form-label">Mission Description</label>
                                <textarea name="mission_description" id="mission_description" class="form-control @error('mission_description') is-invalid @enderror" rows="3">{{ setting('mission_description') ?? old('mission_description') }}</textarea>
                                @error('mission_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="mission_img" class="form-label">Mission Image</label>
                                <input type="file" name="mission_img" class="form-control @error('mission_img') is-invalid @enderror" id="mission_img">
                                @if(setting_img('mission_img'))
                                    <img src="{{ setting_img('mission_img') }}" alt="Mission Image" width="100">
                                @endif
                                @error('mission_img')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
