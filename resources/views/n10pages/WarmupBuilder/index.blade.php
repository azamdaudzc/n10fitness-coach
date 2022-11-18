@extends('layouts.main-layout')

@section('template_title')
    Users
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="fa-solid fa-magnifying-glass position-absolute ms-6"></i>
                            <input type="text" data-kt-user-table-filter="search" id="search_table"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search Warmup" />
                        </div>
                    </div>
                    <div class="card-toolbar">

                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a type="button" class="btn btn-primary" href="{{ route('warmup.builder.create-edit') }}">
                                <i class="fa-solid fa-plus fs-2"></i>Create New
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 table-wth-minh " id="users_table">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th>Name</th>
                                <th>Description</th>
                                <th>Creator</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_drawer_example_basic" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
        data-kt-drawer-toggle=".create_new_off_canvas_modal" data-kt-drawer-close="#kt_drawer_example_basic_close"
        data-kt-drawer-width="500px">
        <div class="py-5 col-12 p-1">
            <div id="subdiv_kt_drawer_example_basic"></div>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
@section('scripts')
    <script type="text/javascript">

        $(function() {

            let form_body = $('#subdiv_kt_drawer_example_basic');
            $('body').on('click', '.view_record', function() {
                let id = $(this).attr('data-id');
                form_body.empty();
                $.post('{{ route('warmup.builder.details') }}', {
                    _token: '{{ csrf_token() }}',
                    id
                }, function(d) {
                    form_body.html(d);
                });
            });
            let table = $('#users_table').DataTable({
                pageLength: 50,
                lenghtChange: false,
                ajax: {
                    url: "{{ route('warmup.builder.list') }}",
                },
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'description'
                    },

                    {
                        data: 'creator'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'actions'
                    },
                ],
            });

            $('#search_table').on('keyup', function() {
                table.search($(this).val()).draw();
            });





            function reloadTable() {
                table.ajax.reload();
                KTDrawer.hideAll();
            }




            $('body').on('click', '.delete_record', function() {
                let id = $(this).attr('data-id');

                Swal.fire({
                    html: `Are you sure you want to delete this question`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "Ok, got it!",
                    cancelButtonText: 'Nope, cancel it',
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then(function(data) {
                    if (data.isConfirmed == true) {
                        $.post('{{ route('warmup.builder.delete') }}', {
                            _token: '{{ csrf_token() }}',
                            id
                        }, function(d) {
                            if (d.success == true) {
                                toastr.success(d.msg);
                                reloadTable();
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
