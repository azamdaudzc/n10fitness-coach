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
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search Client" />
                        </div>
                    </div>
                    <div class="card-toolbar">


                    </div>
                </div>
                <div class="card-body py-4">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="users_table">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th>Client</th>
                                <th>Athletic Type</th>
                                <th>Age</th>
                                <th>Height</th>
                                <th>Gender</th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page_scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
@section('scripts')
    <script type="text/javascript">

        $(function() {



            let table = $('#users_table').DataTable({
                pageLength: 50,
                lenghtChange: false,
                ajax: {
                    url: "{{ route('coach.client.list') }}",
                },
                columns: [{
                        data: 'client'
                    },
                    {
                        data: 'athletic_type'
                    },
                    {
                        data: 'age'
                    },
                    {
                        data: 'height'
                    },
                    {
                        data: 'gender'
                    },


                ],
            });

            $('#search_table').on('keyup', function() {
                table.search($(this).val()).draw();
            });




        });
    </script>
@endsection
