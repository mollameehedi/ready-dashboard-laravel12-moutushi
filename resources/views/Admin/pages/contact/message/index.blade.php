@extends('admin.layouts.app')
@push('title', 'All Contact Messages')
@section('main')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Message</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3>Contact Message</h3>
        </div>
        <div class="card-body">
            <div class="fancy-table rounded">
                <table class="table table-striped table-bordered dt-table">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Number</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(function() {
            $(document).ready(function() {
                let url = "{{ route('contact.message.index') }}";
                var table = $('.dt-table').DataTable({
                    lengthChange: true,
                    processing: true,
                    serverSide: true,
                    responsive:true,
                    autoWidth: false,
                    ajax: url,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'Email'
                        },
                        {
                            data: 'phone',
                            name: 'Number'
                        },
                        {
                            data: 'subject',
                            name: 'Subject'
                        },
                        {
                            data: 'created_at',
                            name: 'Created At'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],
                });
            });
        });
    </script>
    <script type="text/javascript">
          $(document).on('click', '.delete_btn', function (event) {
            event.preventDefault();
            var userConfirmed = confirm("Are you sure you want to proceed?");
            if (userConfirmed) {
                $(this).closest('tr').hide();
                var id = $(this).data('id');

                console.log(id);

                $.ajaxSetup({ // Crucial: Set CSRF token in AJAX requests
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                $.ajax({
                    url: '/contact/message/' + id,
                    type: 'DELETE',
                    success: function(response) {
                        if(response.status == 'success')
                        {
                            toastr.warning("Delete Successfully");
                        }
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            }
        });
    </script>
@endpush
