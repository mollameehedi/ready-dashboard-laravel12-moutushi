@extends('admin.layouts.app')
@push('title', 'Login Log')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Login Log</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Login Log</h3>
        </div>
        <div class="card-body">
            <div class="fancy-table rounded">
                <table class="table table-striped table-bordered dt-table">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Device</th>
                            <th scope="col">Ip</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Status</th>
                            <th scope="col">TIme</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
			var table = $('.dt-table').DataTable( {
				lengthChange: true,
                processing: true,
                serverSide: true,
                responsive:true,
                ajax: '{{ route('admin.loginlog.index') }}',
                columns: [
                        { 
                            data: 'DT_RowIndex', 
                            name: 'DT_RowIndex' 
                        },
                        { 
                            data: 'name', 
                            name: 'name' 
                        },
                        { 
                            data: 'device', 
                            name: 'device' 
                        },
                        { 
                            data: 'ip', 
                            name: 'ip' 
                        },
                        { 
                            data: 'user_agent', 
                            name: 'user_agent' 
                        },
                        { 
                            data: 'status', 
                            name: 'status' 
                        },
                        { 
                            data: 'time', 
                            name: 'time' 
                        },
                    ],
			});
		} );
    </script>
@endpush
