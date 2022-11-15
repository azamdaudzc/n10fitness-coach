@extends('layouts.main-layout')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Appointed Clients</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_client">
                                <!--SVG file not found: media/icons/duotune/art/art008.svg-->
                                Add Client
                            </button>
                            <!--end::Filter-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 pb-5">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="users_table">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th>User</th>
                                        <th>Athletic Type</th>
                                        <th>Age</th>
                                        <th>Height</th>
                                        <th>Gender</th>
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
            <!--begin::Modal - Update user details-->
            <div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Form-->
                        <form class="form" action="#" id="kt_modal_update_user_form">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_update_user_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Update User Details</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                                rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                transform="rotate(45 7.41422 6)" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body py-10 px-lg-17">
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_update_user_header"
                                    data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::User toggle-->
                                    <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                                        href="#kt_modal_update_user_user_info" role="button" aria-expanded="false"
                                        aria-controls="kt_modal_update_user_user_info">User Information
                                        <span class="ms-2 rotate-180">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <!--end::User toggle-->
                                    <!--begin::User form-->
                                    <div id="kt_modal_update_user_user_info" class="collapse show">
                                        <!--begin::Input group-->
                                        <div class="mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                <span>Update Avatar</span>
                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                    title="Allowed file types: png, jpg, jpeg."></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Image input wrapper-->
                                            <div class="mt-1">
                                                <!--begin::Image placeholder-->
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url('assets/media/svg/avatars/blank.svg');
                                                    }

                                                    [data-theme="dark"] .image-input-placeholder {
                                                        background-image: url('assets/media/svg/avatars/blank-dark.svg');
                                                    }
                                                </style>
                                                <!--end::Image placeholder-->
                                                <!--begin::Image input-->
                                                <div class="image-input image-input-outline image-input-placeholder"
                                                    data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-125px h-125px"
                                                        style="background-image: url(assets/media/avatars/300-6.jpg">
                                                    </div>
                                                    <!--end::Preview existing avatar-->
                                                    <!--begin::Edit-->
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Edit-->
                                                    <!--begin::Cancel-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->
                                                    <!--begin::Remove-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->
                                            </div>
                                            <!--end::Image input wrapper-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="name" value="Emma Smith" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                <span>Email</span>
                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                    title="Email address must be active"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" class="form-control form-control-solid" placeholder=""
                                                name="email" value="smith@kpmg.com" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Description</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder=""
                                                name="description" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-15">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Language</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="language" aria-label="Select a Language" data-control="select2"
                                                data-placeholder="Select a Language..."
                                                class="form-select form-select-solid"
                                                data-dropdown-parent="#kt_modal_update_details">
                                                <option></option>
                                                <option value="id">Bahasa Indonesia - Indonesian</option>
                                                <option value="msa">Bahasa Melayu - Malay</option>
                                                <option value="ca">Català - Catalan</option>
                                                <option value="cs">Čeština - Czech</option>
                                                <option value="da">Dansk - Danish</option>
                                                <option value="de">Deutsch - German</option>
                                                <option value="en">English</option>
                                                <option value="en-gb">English UK - British English</option>
                                                <option value="es">Español - Spanish</option>
                                                <option value="fil">Filipino</option>
                                                <option value="fr">Français - French</option>
                                                <option value="ga">Gaeilge - Irish (beta)</option>
                                                <option value="gl">Galego - Galician (beta)</option>
                                                <option value="hr">Hrvatski - Croatian</option>
                                                <option value="it">Italiano - Italian</option>
                                                <option value="hu">Magyar - Hungarian</option>
                                                <option value="nl">Nederlands - Dutch</option>
                                                <option value="no">Norsk - Norwegian</option>
                                                <option value="pl">Polski - Polish</option>
                                                <option value="pt">Português - Portuguese</option>
                                                <option value="ro">Română - Romanian</option>
                                                <option value="sk">Slovenčina - Slovak</option>
                                                <option value="fi">Suomi - Finnish</option>
                                                <option value="sv">Svenska - Swedish</option>
                                                <option value="vi">Tiếng Việt - Vietnamese</option>
                                                <option value="tr">Türkçe - Turkish</option>
                                                <option value="el">Ελληνικά - Greek</option>
                                                <option value="bg">Български език - Bulgarian</option>
                                                <option value="ru">Русский - Russian</option>
                                                <option value="sr">Српски - Serbian</option>
                                                <option value="uk">Українська мова - Ukrainian</option>
                                                <option value="he">עִבְרִית - Hebrew</option>
                                                <option value="ur">اردو - Urdu (beta)</option>
                                                <option value="ar">العربية - Arabic</option>
                                                <option value="fa">فارسی - Persian</option>
                                                <option value="mr">मराठी - Marathi</option>
                                                <option value="hi">हिन्दी - Hindi</option>
                                                <option value="bn">বাংলা - Bangla</option>
                                                <option value="gu">ગુજરાતી - Gujarati</option>
                                                <option value="ta">தமிழ் - Tamil</option>
                                                <option value="kn">ಕನ್ನಡ - Kannada</option>
                                                <option value="th">ภาษาไทย - Thai</option>
                                                <option value="ko">한국어 - Korean</option>
                                                <option value="ja">日本語 - Japanese</option>
                                                <option value="zh-cn">简体中文 - Simplified Chinese</option>
                                                <option value="zh-tw">繁體中文 - Traditional Chinese</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::User form-->
                                    <!--begin::Address toggle-->
                                    <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                                        href="#kt_modal_update_user_address" role="button" aria-expanded="false"
                                        aria-controls="kt_modal_update_user_address">Address Details
                                        <span class="ms-2 rotate-180">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                            <span class="svg-icon svg-icon-3">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <!--end::Address toggle-->
                                    <!--begin::Address form-->
                                    <div id="kt_modal_update_user_address" class="collapse show">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Address Line 1</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="" name="address1"
                                                value="101, Collins Street" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Address Line 2</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder=""
                                                name="address2" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Town</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="" name="city"
                                                value="Melbourne" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row g-9 mb-7">
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">State / Province</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="state" value="Victoria" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Post Code</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="postcode" value="3000" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                <span>Country</span>
                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                    title="Country of origination"></i>
                                            </label>
                                            <!--end::Label-->

                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Address form-->
                                </div>
                                <!--end::Scroll-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                <button type="reset" class="btn btn-light me-3"
                                    data-kt-users-modal-action="cancel">Discard</button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Modal footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
            <!--end::Modal - Update user details-->
            <!--begin::Modal - Add schedule-->
            <div class="modal fade" id="kt_modal_add_client" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Add Client</h2>
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
                                action="{{ route('program.builder.attach-client') }}">
                                @csrf
                                <input type="hidden" name="program_id" id="" value="{{ $program_id }}">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->

                                    <label class="required fs-6 fw-semibold form-label mb-2">Client Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select class="form-select select-2-setup" data-control="select2"
                                        data-placeholder="Select A Client" name="client_id" id="movement_pattern">
                                        <option></option>
                                        @foreach ($all_users as $u)
                                            <option value="{{ $u->user->id }}">{{ $u->user->first_name }}
                                                {{ $u->user->last_name }}
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
            <!--begin::Modal - Add task-->
            <div class="modal fade" id="kt_modal_add_task" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Add a Task</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
                            <form id="kt_modal_add_task_form" class="form" action="#">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-semibold form-label mb-2">Task Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" name="task_name"
                                        value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Task Due Date</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-html="true"
                                            data-bs-content="Select a due date."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Pick date"
                                        name="task_duedate" id="kt_modal_add_task_datepicker" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">Task Description</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-solid rounded-3"></textarea>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3"
                                        data-kt-users-modal-action="cancel">Discard</button>
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
            <!--end::Modal - Add task-->
            <!--begin::Modal - Update email-->
            <div class="modal fade" id="kt_modal_update_email" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Update Email Address</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
                            <form id="kt_modal_update_email_form" class="form" action="#">
                                <!--begin::Notice-->
                                <!--begin::Notice-->
                                <div
                                    class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.3" x="2" y="2" width="20"
                                                height="20" rx="10" fill="currentColor" />
                                            <rect x="11" y="14" width="7" height="2"
                                                rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                            <rect x="11" y="17" width="2" height="2"
                                                rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-semibold">
                                            <div class="fs-6 text-gray-700">Please note that a valid email address is
                                                required to complete the email verification.</div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--end::Notice-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Email Address</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="" name="profile_email"
                                        value="smith@kpmg.com" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3"
                                        data-kt-users-modal-action="cancel">Discard</button>
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
            <!--end::Modal - Update email-->
            <!--begin::Modal - Update password-->
            <div class="modal fade" id="kt_modal_update_password" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Update Password</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
                            <form id="kt_modal_update_password_form" class="form" action="#">
                                <!--begin::Input group=-->
                                <div class="fv-row mb-10">
                                    <label class="required form-label fs-6 mb-2">Current Password</label>
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        placeholder="" name="current_password" autocomplete="off" />
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Input group-->
                                <div class="mb-10 fv-row" data-kt-password-meter="true">
                                    <!--begin::Wrapper-->
                                    <div class="mb-1">
                                        <!--begin::Label-->
                                        <label class="form-label fw-semibold fs-6 mb-2">New Password</label>
                                        <!--end::Label-->
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid" type="password"
                                                placeholder="" name="new_password" autocomplete="off" />
                                            <span
                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                <i class="bi bi-eye-slash fs-2"></i>
                                                <i class="bi bi-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <!--end::Input wrapper-->
                                        <!--begin::Meter-->
                                        <div class="d-flex align-items-center mb-3"
                                            data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                        <!--end::Meter-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Hint-->
                                    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &
                                        symbols.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-10">
                                    <label class="form-label fw-semibold fs-6 mb-2">Confirm New Password</label>
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                        placeholder="" name="confirm_password" autocomplete="off" />
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3"
                                        data-kt-users-modal-action="cancel">Discard</button>
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
            <!--end::Modal - Update password-->
            <!--begin::Modal - Update role-->
            <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Update User Role</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
                            <form id="kt_modal_update_role_form" class="form" action="#">
                                <!--begin::Notice-->
                                <!--begin::Notice-->
                                <div
                                    class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.3" x="2" y="2" width="20"
                                                height="20" rx="10" fill="currentColor" />
                                            <rect x="11" y="14" width="7" height="2"
                                                rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                            <rect x="11" y="17" width="2" height="2"
                                                rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-semibold">
                                            <div class="fs-6 text-gray-700">Please note that reducing a user role rank,
                                                that user will lose all priviledges that was assigned to the previous role.
                                            </div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--end::Notice-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-5">
                                        <span class="required">Select a user role</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input row-->
                                    <div class="d-flex">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="user_role" type="radio"
                                                value="0" id="kt_modal_update_role_option_0" checked='checked' />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                <div class="fw-bold text-gray-800">Administrator</div>
                                                <div class="text-gray-600">Best for business owners and company
                                                    administrators</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="user_role" type="radio"
                                                value="1" id="kt_modal_update_role_option_1" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                <div class="fw-bold text-gray-800">Developer</div>
                                                <div class="text-gray-600">Best for developers or people primarily using
                                                    the API</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="user_role" type="radio"
                                                value="2" id="kt_modal_update_role_option_2" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_2">
                                                <div class="fw-bold text-gray-800">Analyst</div>
                                                <div class="text-gray-600">Best for people who need full access to
                                                    analytics data, but don't need to update business settings</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="user_role" type="radio"
                                                value="3" id="kt_modal_update_role_option_3" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_3">
                                                <div class="fw-bold text-gray-800">Support</div>
                                                <div class="text-gray-600">Best for employees who regularly refund
                                                    payments and respond to disputes</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class='separator separator-dashed my-5'></div>
                                    <!--begin::Input row-->
                                    <div class="d-flex">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            <input class="form-check-input me-3" name="user_role" type="radio"
                                                value="4" id="kt_modal_update_role_option_4" />
                                            <!--end::Input-->
                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_modal_update_role_option_4">
                                                <div class="fw-bold text-gray-800">Trial</div>
                                                <div class="text-gray-600">Best for people who need to preview content
                                                    data, but don't need to make any updates</div>
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3"
                                        data-kt-users-modal-action="cancel">Discard</button>
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
            <!--end::Modal - Update role-->
            <!--begin::Modal - Add task-->
            <div class="modal fade" id="kt_modal_add_auth_app" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Add Authenticator App</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
                            <!--begin::Content-->
                            <div class="fw-bold d-flex flex-column justify-content-center mb-5">
                                <!--begin::Label-->
                                <div class="text-center mb-5" data-kt-add-auth-action="qr-code-label">Download the
                                    <a href="#">Authenticator app</a>, add a new account, then scan this barcode to
                                    set up your account.
                                </div>
                                <div class="text-center mb-5 d-none" data-kt-add-auth-action="text-code-label">Download
                                    the
                                    <a href="#">Authenticator app</a>, add a new account, then enter this code to
                                    set up your account.
                                </div>
                                <!--end::Label-->
                                <!--begin::QR code-->
                                <div class="d-flex flex-center" data-kt-add-auth-action="qr-code">
                                    <img src="assets/media/misc/qr.png" alt="Scan this QR code" />
                                </div>
                                <!--end::QR code-->
                                <!--begin::Text code-->
                                <div class="border rounded p-5 d-flex flex-center d-none"
                                    data-kt-add-auth-action="text-code">
                                    <div class="fs-1">gi2kdnb54is709j</div>
                                </div>
                                <!--end::Text code-->
                            </div>
                            <!--end::Content-->
                            <!--begin::Action-->
                            <div class="d-flex flex-center">
                                <div class="btn btn-light-primary" data-kt-add-auth-action="text-code-button">Enter code
                                    manually</div>
                                <div class="btn btn-light-primary d-none" data-kt-add-auth-action="qr-code-button">Scan
                                    barcode instead</div>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add task-->
            <!--begin::Modal - Add task-->
            <div class="modal fade" id="kt_modal_add_one_time_password" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Enable One Time Password</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
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
                            <form class="form" id="kt_modal_add_one_time_password_form">
                                <!--begin::Label-->
                                <div class="fw-bold mb-9">Enter the new phone number to receive an SMS to when you log in.
                                </div>
                                <!--end::Label-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Mobile number</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="A valid mobile number is required to receive the one-time password to validate your account login."></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid"
                                        name="otp_mobile_number" placeholder="+6123 456 789" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Separator-->
                                <div class="separator saperator-dashed my-5"></div>
                                <!--end::Separator-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Email</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="email" class="form-control form-control-solid" name="otp_email"
                                        value="smith@kpmg.com" readonly="readonly" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Confirm password</span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="password" class="form-control form-control-solid"
                                        name="otp_confirm_password" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3"
                                        data-kt-users-modal-action="cancel">Cancel</button>
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
            <!--end::Modal - Add task-->
            <!--end::Modals-->
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
                url: "{{ route('program.builder.assigedclients', $program_id) }}",
            },
            columns: [{
                    data: 'user'
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
                {
                    data: 'actions'
                },
            ],
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
                    $.post('{{ route('program.builder.deleteclient') }}', {
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
