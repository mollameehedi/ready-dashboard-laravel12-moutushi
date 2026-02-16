@extends('admin.layouts.app')
@push('title', 'About Page | Settings')
@push('settings', 'active')
@section('main')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Dashboard</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="bx bx-home-alt"></i></a>
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
            <div class="card-body">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">List of Banners</h5>
                    <a href="{{ route('website.banner.create') }}" class="btn btn-primary mb-3">Create Banner</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                {{-- <th>Image</th> --}}
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('website.banner.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    // {
                    //     data: 'image',
                    //     name: 'image',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    { data: 'name', name: 'name' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });
        });
        deleteMethod();
    </script>
@endpush
