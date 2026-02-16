@extends('admin.layouts.app')
@push('title', 'Social Media Link | Settings')
@push('style')
<link href="{{ asset('assets') }}/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
@endpush
@section('main')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Dashboard</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="bx bx-home-alt"></i></a>
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
                    <h4 class="mb-0 text-primary">Meta Tag</h4>
                </div>
            </div>
            <form action="{{ route('settings.meta_tag.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-3">
                            <label for="meta_title" class="col-3 col-form-label">Meta Title</label>
                            <div class="col-9">
                                <input type="text" class="form-control" value="{{ setting('meta_title') }}" id="meta_title" name="meta_title" placeholder="Meta Title">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="meta_keyword" class="col-3 col-form-label">Meta Keyword</label>
                            <div class="col-9">
                                <input type="text" class="form-control" data-role="tagsinput" value="{{ setting('meta_keyword') }}" name="meta_keyword" placeholder="Meta Keyword">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="meta_description" class="col-3 col-form-label">Meta Description</label>
                            <div class="col-9">
                                <textarea name="meta_description" id="meta_description" class="form-control" cols="3">{{ setting('meta_description') }}</textarea>
                            </div>
                        </div>
                        </div>


                        {{-- ... (Your existing form fields for other settings) --}}

                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-primary rounded mt-3">Update</button>
                        <a href="{{ route('settings.general.index') }}" class="btn btn-danger rounded mt-3">Cancel</a>

                    </div>
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
