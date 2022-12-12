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
                            <h2>Shared With Coaches</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_client">
                                <!--SVG file not found: media/icons/duotune/art/art008.svg-->
                                Add Coaches
                            </button>
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
                                        <th>User</th>
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

            <!--begin::Modal - Add schedule-->
            <div class="modal fade" id="kt_modal_add_client" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Share With Coach</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="closeModal()">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16"
                                            height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                            fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2"
                                            rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form id="kt_modal_add_client_form" method="POST" class="form"
                                action="{{ route('program.share.save') }}">
                                @csrf
                                <input type="hidden" name="program_id" id="attachment_program_id"  value="{{$program_id}}">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->

                                    <label class="required fs-6 fw-semibold form-label mb-2">Coach Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select class="form-select select-2-setup" data-control="select2"
                                        data-placeholder="Select A Client" name="coach_id" id="movement_pattern">
                                        <option></option>
                                        @foreach ($all_users as $u)
                                            <option value="{{ $u->id }}">{{ $u->first_name }}
                                                {{ $u->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel"
                                        onclick="closeModal()">Discard</button>
                                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add schedule-->

        </div>
        <!--end::Content container-->
    </div>
@endsection

@section('page_scripts')
    <script>
        let table = null;
        $(function() {

            $('.select-2-setup').select2();


         table = $('#users_table').DataTable({
            pageLength: 50,
            lenghtChange: false,
            ajax: {
                url: "{{ route('program.share.coaches',$program_id )}}",
            },
            columns: [{
                    data: 'user'
                },
                {
                    data: 'actions'
                },
            ],
    });

});

        $('body').on('click', '.delete_record', function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                html: `Are you sure you want to delete this client`,
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
                    $.post('{{ route('program.share.delete') }}', {
                        _token: '{{ csrf_token() }}',
                        id
                    }, function(d) {
                        if (d.success == true) {
                            toastr.success(d.msg);
                            table.ajax.reload(null, false);
                        }
                    });
                }
            });
        });

        function closeModal() {
            $('#kt_modal_add_client').modal('hide');
        }


        $(document).on("submit", "form", function(event) {
            event.preventDefault();
            $('#crud-form-submit-button').attr("data-kt-indicator", "on");

            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),

                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(d, status) {
                    if (d.success == true) {
                        toastr.success(d.msg);
                        table.ajax.reload(null, false);
                        closeModal();
                    } else {
                        toastr.error(d.msg);
                        closeModal();
                    }
                    $('#crud-form-submit-button').attr("data-kt-indicator", "off");

                },
                error: function(data) {
                    var response = JSON.parse(data.responseText);
                    var errorString = '<ul>';
                    $.each(response.errors, function(key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul>';
                    $('.error-area').html('');
                    toastr.error(errorString);
                    $('#crud-form-submit-button').attr("data-kt-indicator", "off");

                }
            });

        });
    </script>
@endsection
