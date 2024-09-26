@extends('layouts.admin')

@section('title', 'User List')


@section('content')

    <x-breadcumb title="User List" />

    <div class="table-responsive">

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <button class="btn btn-warning" id="bulk-delete-btn">
                            Delete Selected Items
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                {{-- <th>SL</th> --}}
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Name</th>
                                <th>phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
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


@endsection


@push('style')
    <link href="{{ asset('backend/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endpush

@push('script')
    <script src="{{ asset('backend/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>


    <script>
        $(document).ready(function() {

            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print'],
                processing: true,
                serverSide: true,
                ajax: '{{ route($role . 'user.index') }}',
                columns: [
                    // {
                    //     data: 'id',
                    //     name: 'id'
                    // },
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            // Handle 'select all' checkbox
            $('#select-all').on('click', function() {
                var rows = table.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // Handle individual row checkbox click
            $('#userTable tbody').on('change', 'input[type="checkbox"]', function() {
                if (!this.checked) {
                    var el = $('#select-all').get(0);
                    if (el && el.checked && ('indeterminate' in el)) {
                        el.indeterminate = true;
                    }
                }
            });

            // Bulk delete action
            $('#bulk-delete-btn').on('click', function(e) {
                var selectedRows = [];
                $('input.row-checkbox:checked').each(function() {
                    selectedRows.push($(this).val());
                });

                if (selectedRows.length > 0) {
                    // use Swal

                    Swal.fire({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover these users!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ route($role . 'users.bulkDelete') }}',
                                method: 'POST',
                                data: {
                                    ids: selectedRows,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    if (response.success) {
                                        alert(response.message);
                                        table.ajax
                                            .reload();
                                    } else {
                                        alert('Something went wrong!');
                                    }
                                }
                            });
                        }
                    });


                } else {
                    flash('error', 'Please select at least one user to delete');
                }
            });
        });
    </script>
@endpush
