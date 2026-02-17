// function dataDelete(url, rowElement) {


//     $.ajax({
//         url: url,
//         type: 'DELETE',
//         success: function(response) {
//             if (response.status == 'success') {
//                 toastr.success(response.message);
//                 if (rowElement) {
//                     $(rowElement).closest('tr').hide();
//                 }
//             } else {
//                 toastr.warning(response.message);
//             }
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             console.error('Delete Error:', jqXHR);
//             if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
//                 toastr.warning(jqXHR.responseJSON.message);
//             } else {
//                 toastr.error('An error occurred while trying to delete.');
//             }
//         }
//     });
// }


function deleteMethod() {
    $(document).on('click', '.delete_btn', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
console.log(url,'mehedi');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                            // Assuming 'table' is defined in the scope where this function is called
                            if (typeof table !== 'undefined' && table.ajax && typeof table.ajax.reload === 'function') {
                                table.ajax.reload();
                            } else {
                                // If 'table' is not available, you might need to reload the page
                                window.location.reload();
                            }
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            Swal.fire(
                                'Error!',
                                xhr.responseJSON.message,
                                'error'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                'An error occurred while trying to delete.',
                                'error'
                            );
                        }



                    }
                });
            }
        });
    });
}
