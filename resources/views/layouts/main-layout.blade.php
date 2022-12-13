<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>N10 | Fitness</title>
    <meta charset="utf-8" />
    <meta name="description" content="N10 Fitness" />
    <meta name="keywords" content="N10 Fitness" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta property="og:title" content="N10 | Fitness" />
    <meta property="og:url" content="https://n10fitness.com" />
    <meta property="og:site_name" content="n10fitness |" />
    <link rel="canonical" href="https://preview.n10fitness.com" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .error-area ul {
            list-style: none
        }

        .setAllInfo {
            list-style: none
        }

        .error-area ul li {
            color: red
        }


        ul.setAllInfo li {
            padding: 10px;
            font-size: medium;
        }

        .dataTables_filter,
        .dataTables_length {
            display: none;
        }

        .dataTables_paginate a {
            padding: 10px;

        }

        .paginate_button.current {
            background-color: green;
            color: aliceblue;
            border-radius: 8px;
        }

        .thumbnail-image {
            width: 75px;
            height: 75px;
            border-radius: 21px;
        }



        .image-input-wrapper {
            background-repeat: no-repeat !important;
            background-size: contain !important;
        }
    </style>


    <style>
        .warmupvideo-container {
            position: relative;

            width: 444px;
            height: 200px;
        }

        .warmupvideo-image {
            opacity: 1;
            display: block;
            width: 100%;
            height: 200px;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .warmupvideo-overlay {
            position: absolute;
            top: 10px;
            left: 0;
            width: 444px;
            height: 200px;
            background: rgba(0, 0, 0, 0);
            transition: background 0.5s ease;
        }

        .warmupvideo-container:hover .warmupvideo-overlay {
            display: block;
            background: rgba(0, 0, 0, .3);
        }

        .warmupvideo-button {
            position: absolute;
            width: 444px;
            left: 0;
            top: 60px;
            text-align: center;
            opacity: 0;
            transition: opacity .35s ease;
        }

        .warmupvideo-button img {
            width: 180px;
            padding: 12px 48px;
            text-align: center;
            color: white;
            z-index: 1;
        }

        .warmupvideo-container:hover .warmupvideo-button {
            opacity: 1;
        }

        .program-table thead {
            font-weight: bold;
        }

        .program-table {
            width: 100%
        }

        .center-vertical {
            margin: auto;
            width: 50%;
            padding: 10px;
        }

        .center {
            text-align: center;

        }

        .program-table thead {
            background-color: #767676;
            color: white;
        }

        .program-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .program-main-area {
            overflow-x: auto;
            display: flex;
        }

        .program-sub-area {
            padding: 10px;
            margin: 10px;
        }

        hr.solid {
            border-top: 3px solid #bbb;
        }

        .editable-program-table tr td input {
            width: 50px
        }

        .notification {
            color: white;
            text-decoration: none;
            position: relative;
            display: inline-block;
            border-radius: 2px;
        }


        .notification .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 2px 5px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }

        .table-responsive,
        .dataTables_scrollBody {
            overflow: visible !important;
        }

        .analytics-weeks{
            color: white !important;
            background-color: red !important;
        }

        .analytics-head{
            color: white !important;
            background-color: rgb(46, 39, 39) !important;
            padding-left: 10px !important;
        }
    </style>

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            {{-- @include('includes.header') --}}
            <div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate-="true"
                data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: '100px', lg: '100px'}"
                style="height: 30px">
            </div>
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('includes.sidebar')
                @yield('content')
            </div>

        </div>

    </div>


    {{--  @include('includes.drawers') --}}


    <!--end::Scrolltop-->
    {{-- @include('includes.modals') --}}
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toastr-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    @yield('page_scripts')
    @yield('sub_page_scripts')
    <!--end::Vendors Javascript-->
    <!--end::Javascript-->
    @yield('scripts')

    <script>
        $(function() {
            var current = location.pathname;
            if (current != '/') {
                $('.menu-link').removeClass('active');
                $('.menu-link').parent().parent().parent().removeClass('here');
            } else {
                $('#main_dashboard_menu').addClass('here');
                $('#main_dashboard_menu_item').addClass('active');
            }
            $('.menu-link').each(function() {
                var $this = $(this);
                if (current != '/') {

                    if ($this.attr('href')) {
                        var splitted = current.split("/");
                        current = '/' + splitted[1] + '/' + splitted[2];
                        if ($this.attr('href').indexOf(current) !== -1) {
                            $this.addClass('active');
                            $this.parent().parent().parent().addClass('here');
                        }
                    }

                }
            })
        })

        function closemodal() {

            $("#kt_modal_add_user").modal('hide');
        }
        $(document).ready(function() {
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
        $('#kt_modal_add_user').on('shown.bs.modal', function(e) {
            // do something...
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $('input[name=_token]').val("{{ csrf_token() }}");
        })

        $(".notification-main-icon").click(function(){

            $.get('{{route('mark.notification.done')}}', function (){
            });
        });
    </script>

</body>
<!--end::Body-->

</html>
