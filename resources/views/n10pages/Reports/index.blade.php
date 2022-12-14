@extends('layouts.main-layout')

@section('template_title')
    Users
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <h2>Clients</h2>



                    @if($programs->count()==0)
                    <label for="">No Programs Assigned To Any Clients</label>
                    @endif
                    <ul style="list-style: none">
                    @foreach($programs as $p)
                       <li class="mt-5 border p-6 shadow" style="border-radius: 10px">
                            <div class="d-flex justify-content-between">
                                <div class="text-body fs-5"><strong>Name: </strong>{{$p->user->first_name}} {{$p->user->last_name}}
                                </div>
                                <div>
                                    <ul style="list-style: none">
                                        <li class="text-body"><strong>Program: </strong>{{$p->program->title}}</li>
                                        <li class="text-body"> <strong>Age: </strong>{{$p->user->age}}</li>
                                        <li class="text-body"><strong>Height: </strong>{{$p->user->height}}</li>
                                        <li><a href="{{route('client.reports.exercise-summary-report',$p->id)}}">
                                        <button class="btn btn-light-danger h-30px mt-2 pt-1 w-100">Load Report</button>
                                        </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                         </li>
                    @endforeach
                    </ul>


        </div>
    </div>

@endsection

@section('page_scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
@section('scripts')

@endsection
