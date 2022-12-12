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
                            {{-- <i class="fa-solid fa-magnifying-glass position-absolute ms-6"></i>
                            <input type="text" data-kt-user-table-filter="search" id="search_table"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search Warmup" /> --}}
                                <h2>Clients</h2>
                        </div>
                    </div>
                 
                </div>
                <div class="card-body py-4">
                    <ul>
                    @foreach($programs as $p)
                        <li><a href="{{route('client.reports.exercise-summary-report',$p->id)}}">{{$p->user->first_name}} {{$p->user->last_name}}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
   
@endsection

@section('page_scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
@section('scripts')
    
@endsection
