@extends('layouts.main-layout')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9 col-12">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Shared With You</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Filter-->

                            <!--end::Filter-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 pb-5">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive table-wth-minh">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="users_table">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th>Name</th>
                                        <th>Weeks</th>
                                        <th>Days</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->

            </div>
            <!--end::Layout-->
            <!--begin::Modals-->



        </div>
        <!--end::Content container-->
    </div>
@endsection

@section('page_scripts')
    <script>
        $(function() {

            $('.select-2-setup').select2();
        });

        let table = $('#users_table').DataTable({
            pageLength: 50,
            lenghtChange: false,
            ajax: {
                url: "{{ route('program.sharedwith.list') }}",
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'weeks'
                },
                {
                    data: 'days'
                },
                {
                    data: 'createdAt'
                },
                {
                    data: 'actions'
                },
            ],
        });



    </script>
@endsection
