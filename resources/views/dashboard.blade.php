@extends('layouts.main-layout')

@section('content')
 <!--begin::Main-->
 <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Row-->
                <div class="row g-5 g-xl-10">

                    <!--begin::Col-->
                    <div class="col-xl-8 mb-5 mb-xl-10">
                        <!--begin::Engage widget 12-->
                        <div class="card card-custom bg-body border-0 h-md-100">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-center flex-wrap ps-xl-15 pe-0">
                                <!--begin::Wrapper-->
                                <div class="flex-grow-1 mt-2 me-9 me-md-0">
                                    <!--begin::Title-->
                                    <div class="position-relative text-gray-800 fs-1 z-index-2 fw-bold mb-5">N10 Fitness Coach </div>
                                    <!--end::Title-->
                                    <!--begin::Text-->
                                    <span class="text-gray-600 fw-semibold fs-6 mb-6 d-block">N10 Fitness Coach Side</span>
                                    <!--end::Text-->
                                    <!--begin::Action-->

                                    <!--begin::Action-->
                                </div>
                                <!--begin::Wrapper-->
                                <!--begin::Illustration-->
                                <img src="assets/media/illustrations/misc/credit-card.png" class="h-175px me-15" alt="" />
                                <!--end::Illustration-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Engage widget 12-->
                    </div>
                    <!--end::Col-->

                    <div class="col-xl-8 mb-5 mb-xl-10">
                        <!--begin::Table widget 6-->
                        <div class="card card-flush h-md-100">
                            <!--begin::Header-->
                            <div class="card-header pt-7">
                                <!--begin::Title-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-800">Total Stats</span>

                                </h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Nav-->
                                <ul class="nav nav-pills nav-pills-custom mb-3" role="tablist">
                                    <!--begin::Item-->
                                    <li class="nav-item mb-3 me-3 me-lg-6" role="presentation">
                                        <!--begin::Link-->
                                        <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 active" data-bs-toggle="pill" href="#kt_stats_widget_6_tab_1" aria-selected="true" role="tab">
                                            <!--begin::Icon-->
                                            <div class="nav-icon mb-3">
                                                <i class="fonticon-truck fs-1 p-0"></i>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Users</span>
                                            <!--end::Title-->
                                            <!--begin::Bullet-->
                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                            <!--end::Bullet-->
                                        </a>
                                        <!--end::Link-->
                                    </li>
                                    <!--end::Item-->


                                </ul>
                                <!--end::Nav-->
                                <!--begin::Tab Content-->
                                <div class="tab-content">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade active show" id="kt_stats_widget_6_tab_1" role="tabpanel">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                        <th class="p-0 w-200px w-xxl-450px"></th>
                                                        <th class="p-0 min-w-150px"></th>
                                                        <th class="p-0 min-w-150px"></th>
                                                        <th class="p-0 min-w-190px"></th>
                                                        <th class="p-0 w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    @foreach($users as $user)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-40px me-3">
                                                                    @if ($user->avatar != null)
                                                                    <img src="{{  $user->avatar }}" alt="image" />
                                                                @else
                                                                    <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="image" />
                                                                @endif
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$user->first_name}} {{$user->last_name}}</a>
                                                                    <span class="text-muted fw-semibold d-block fs-7">{{$user->email}}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-800 fw-bold d-block mb-1 fs-6">{{$user->sets_completed}}</span>
                                                            <span class="fw-semibold text-gray-400 d-block">Sets Perfomed</span>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{$user->total_reps}}</a>
                                                            <span class="text-muted fw-semibold d-block fs-7">Total Reps</span>
                                                        </td>
                                                        <td>
                                                            <div class="rating">
                                                                <div class="rating-label me-1 checked">
                                                                    <i class="bi bi-star-fill fs-6s"></i>
                                                                </div>
                                                                <div class="rating-label me-1 checked">
                                                                    <i class="bi bi-star-fill fs-6s"></i>
                                                                </div>
                                                                <div class="rating-label me-1 checked">
                                                                    <i class="bi bi-star-fill fs-6s"></i>
                                                                </div>
                                                                <div class="rating-label me-1 checked">
                                                                    <i class="bi bi-star-fill fs-6s"></i>
                                                                </div>
                                                                <div class="rating-label me-1 checked">
                                                                    <i class="bi bi-star-fill fs-6s"></i>
                                                                </div>
                                                            </div>
                                                            <span class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="{{route('client.reports.exercise-summary-report',$user->id)}}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
                                                                <span class="svg-icon svg-icon-5 svg-icon-gray-700">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="currentColor"></path>
                                                                        <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="currentColor"></path>
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->


                                </div>
                                <!--end::Tab Content-->
                            </div>
                            <!--end: Card Body-->
                        </div>
                        <!--end::Table widget 6-->
                    </div>

                </div>
                <!--end::Row-->


            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->
    <div id="kt_app_footer" class="app-footer">
        <!--begin::Footer container-->
        <div class="app-container container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted fw-semibold me-1">2022&copy;</span>
                <a href="https://n10fitness.com" target="_blank" class="text-gray-800 text-hover-primary">N10Fitness</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Menu-->

            <!--end::Menu-->
        </div>
        <!--end::Footer container-->
    </div>
    <!--end::Footer-->
</div>
<!--end:::Main-->

@endsection

@section('page-scripts')
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::Custom Javascript-->
@endsection
