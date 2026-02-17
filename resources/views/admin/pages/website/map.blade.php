@extends('admin.layouts.app')
@push('title', 'Map | Settings')
@push('settings', 'active')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Map</li>
            </ol>
        </nav>
    </div>
</div>

  @include('admin.pages.website.sidebar')           
    <div class="col-lg-12">
    <div class="card border border-2 border-primary p-4">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-0 text-primary">Map Information</h4>
                </div>
            </div>
            <form action="{{ route('admin.settings.website.map.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="map_location" class="form-label">Map Location (iframe)</label>
                                <textarea name="map_location" id="map_location" class="form-control @error('map_location') is-invalid @enderror" rows="5">{{ setting('map_location') ?? old('map_location') }}</textarea>
                                @error('map_location')
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
