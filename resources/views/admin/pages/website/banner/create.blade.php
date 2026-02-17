@extends('admin.layouts.app')
@push('title', 'About Page | Settings')
@push('settings', 'active')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Dashboard</div>
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
    @include('admin.pages.website.sidebar')          
    <div class="col-lg-12">
        <div class="card border-top border-0 border-4 border-primary p-4">
            <div class="card-title text-center">
                <h3>Add New Banner</h3>
              </div>
              <div class="crad-body">
                <form action="{{ route('admin.settings.website.banner.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="image" class="form-label">Name</label>
                      <input type="text" id="image" name="name" placeholder="Enter Your Banner name" class="form-control">
                    </div>
                  <div class="mb-3">
                    <label for="image" class="form-label">Image <small>(We recommend 1300 * 500 pixels image for perfect view)</small></label>
                      <input type="file" id="image" name="image" class="form-control">
                    </div>
                    @error('image')
                        <div class="alert alert-danger" role="alert">
                          <strong>Error - </strong>{{ $message }}
                        </div>
                      @enderror
                </div>
                  <div class="d-flex">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('admin.settings.website.banner.index')}}" class="btn btn-danger ms-2">Cancel</a>
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
