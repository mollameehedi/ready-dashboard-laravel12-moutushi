@extends('admin.layouts.app')
@push('title', 'Profile')
@push('profile', 'active')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
           <div class="card border border-2 border-primary p-4">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <label for="image">
                            <img id="image-preview" src="{{get_image_url(auth()->user(), 'avatar') }}" alt="Admin" class="rounded-circle p-1 bg-primary" height="110" width="110">
                        </label>
                        <div class="mt-3">
                            <h4>{{auth()->user()->name}}</h4>
                            <p class="text-secondary mb-1">Super Admin</p>
                        </div>
                    </div>
                    <hr class="my-1" />
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><i class="lni lni-envelope"></i> Email</h6>
                            <span class="text-secondary">{{auth()->user()->email}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card border border-2 border-primary p-4">
                <div class="card-body">
                    <form action="{{route('admin.profile.upload.image')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control form-control-sm" id="image" name="avatar" type="file">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" value="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card border border-2 border-primary p-4">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="mb-0 text-primary">Profile Information</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group mt-2">
                            <label class="form-label" for="email1101">Full Name</label>
                            <input type="text" name="name" class="form-control" id="email1101"
                                value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label" for="email1101">Email</label>
                            <input type="email" name="email" class="form-control" id="email1101"
                                value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label" for="number">Phone Number</label>
                            <input type="text" name="number" class="form-control" id="number"
                                value="{{ Auth::user()->number }}">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-danger mt-3">cancel</a>
                    </form>
                </div>
            </div>
          <div class="card border border-2 border-primary p-4">
                <form method="post" action="{{ route('admin.profile.password') }}">
                    @csrf
                    @method('put')
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Change Your Password</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group mt-2">
                            <label class="form-label" for="pwd">Old Password</label>
                            <input type="password" class="form-control" name="old_password" id="pwd">
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label" for="pwd">New Password</label>
                            <input type="password" class="form-control" name="password" id="pwd">
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label" for="pwd">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="pwd">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-danger mt-3">cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                const file = this.files[0];
                if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                } else {
                $('#image-preview').attr('src', '#');
                }
            });
        });
    </script>
        <script>
            $('.select2').select2({
                placeholder: "Select A Country",
                allowClear: Boolean($(this).data('allow-clear')),
                theme: 'bootstrap4',
            });
            </script>
@endpush
