@extends('admin.layouts.app')
@push('title', 'Facebook Pixel | Settings')
@push('style')
<link href="{{ asset('assets') }}/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
@endpush
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Facebook Pixel</li>
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
                    <h4 class="mb-0 text-primary">Facebook Pixel</h4>
                </div>
            </div>
            <form action="{{ route('admin.settings.fb_pixel.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-3">
                            <div class="col-12">
                                <textarea name="fb_pixel" id="fb_pixel" class="form-control" cols="3">{{ setting('fb_pixel') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-primary rounded mt-3">Update</button>
                    <a href="{{ route('admin.settings.general.index') }}" class="btn btn-danger rounded mt-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script>
        $('#title').on('blur', function() {
            var title = $(this).val();
            var slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#slug').val(slug);
        });
    </script>
@endpush
