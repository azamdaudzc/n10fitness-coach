@extends('layouts.main-layout')

@section('template_title')
    Users
@endsection

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card shadow-sm">
                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                    <h3 class="card-title">Program</h3>
                    <div class="card-toolbar">
                        @if($program->created_by == Auth::user()->id)
                        <button type="button"  onclick="openSemiUpdateModal('program_name')">
                            <i class="fa fa-edit"></i>
                        </button>
                        @endif
                    </div>
                </div>
                    <div class="card-body">
                        <div class="mb-5">
                            <label for="program-name"><strong>Program Name</strong></label><br>
                            <label for="">{{ $program->title }}</label>
                        </div>
                        <div class="mb-5">
                            <label for="program-groups"><strong>Program Weeks</strong></label><br>
                            <label for="">{{ $program->weeks }}</label>
                        </div>
                        <div class="mb-5">
                            <label for="program-days"><strong>Program Days</strong></label><br>
                            <label for="">{{ $program->days }}</label>
                        </div>
                    </div>

            </div>
            <div class="accordion" id="kt_accordion_1">
                @for ($i = 1; $i <= $week_group_count; $i++)
                <div class="card card-dashed mt-5">
                    <div class="card-header">
                        <h3 class="card-title">Group {{ $per_group_data[$i]->week_group }} [ Week:
                            {{ $week_group_range[$i]->StartFrom }} -
                            Week:
                            {{ $week_group_range[$i]->EndTo }} ]</h3>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <div class="card-body">

                    <div class="program-main-area">
                        <div class="program-sub-area col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                                    <h3 class="card-title fs-7">Calories-Proteins</h3>
                                    <div class="card-toolbar">
                                        @if($program->created_by == Auth::user()->id)
                                        <button type="button"  class="" onclick="openSemiUpdateModal('calories_proteins','{{$week_group_range[$i]->StartFrom}}','{{$week_group_range[$i]->EndTo}}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                                     <div class="card-body">


                            <div class="pro-cal-area table-responsive " style="width:100%">
                                <table class="table">
                                    <thead>
                                        <tr><td></td><td>Calo</td><td>Prot</td></tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($all_group_data as $item)
                                         @if ($item->week_no <= $week_group_range[$i]->EndTo && $item->week_no >= $week_group_range[$i]->StartFrom)

                                        <tr><td>Week
                                            {{ $item->week_no }}</td>
                                        <td> {{ $item->assigned_calories }}</td>
                                        <td> {{ $item->assigned_proteins }}</td></tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            </div>
                        </div>
                        @for ($j = 1; $j <= $program->days; $j++)

                            <div class="program-sub-area col-md-5">
                                <div class="card shadow-sm ">
                                    <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                                        <h3 class="card-title">Day {{ $j }} [ {{$day_title[$i][$j]}} ] </h3>
                                        <div class="card-toolbar">
                                            @if($program->created_by == Auth::user()->id)
                                            <button type="button"  class="" onclick="openSemiUpdateModal('program_day_edit','{{$week_group_range[$i]->StartFrom}}','{{$week_group_range[$i]->EndTo}}','{{$j}}','{{$per_group_data[$i]->week_group}}')">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                        <div class="card-body">

                                <Strong>Warmups :</Strong> <br>
                                <ul class="h-100px">
                                    @foreach ($warmups as $w)
                                        @if (in_array($w->id, $selected_warmup_ids[$i][$j]))
                                            <li>{{ $w->name }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="form-group">
                                    @php
                                        $count=0;
                                    @endphp
                                    @foreach ($week_day_exercise_data[$i][$j] as $exercise)
                                        <div class="mt-10">
                                            <hr class="solid">
                                            <div class="mt-5 mb-5 h-50px">
                                                @foreach ($exercises as $w)
                                                    @if ($exercise->exercise_library_id == $w->id)
                                                        <strong>Exercise:</strong><br>
                                                        {{ $w->name }}
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="mt-5 mb-5 h-50px">
                                                <label for=""><strong>Note:</strong></label><br>
                                                {{ $week_day_exercise_set[$i][$j][$count][$week_group_range[$i]->EndTo]->notes }}

                                            </div>

                                            <div class="table-responsive ">
                                                <table class="table-bordered program-table">
                                                    <thead>
                                                        <tr>
                                                            <td>#</td>
                                                            <td>Sets
                                                            </td>
                                                            <td colspan="2">Reps
                                                            </td>
                                                            <td>RPE</td>
                                                            <td>Load
                                                            </td>
                                                            <td>Rest
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($wr = $week_group_range[$i]->StartFrom; $wr <= $week_group_range[$i]->EndTo; $wr++)
                                                            <tr>
                                                                <td>{{ $wr }}
                                                                </td>

                                                                <td>{{ $week_day_exercise_set[$i][$j][$count][$wr]->set_no }}
                                                                </td>
                                                                <td>{{ $week_day_exercise_set[$i][$j][$count][$wr]->rep_min_no }}
                                                                </td>
                                                                <td>{{ $week_day_exercise_set[$i][$j][$count][$wr]->rep_max_no }}
                                                                </td>
                                                                <td>{{ $week_day_exercise_set[$i][$j][$count][$wr]->rpe_no }}
                                                                </td>
                                                                <td>{{ $week_day_exercise_set[$i][$j][$count][$wr]->load_text }}
                                                                </td>
                                                                <td> {{ $week_day_exercise_set[$i][$j][$count][$wr]->rest_time }}
                                                                </td>

                                                            </tr>
                                                        @endfor

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @php
                                            $count++
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                            </div>
                            </div>
                        @endfor
                    </div>
                    </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" id="protien_calories_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal_name">Edit Calories & Proteins</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{route('exercise.library.semiupdate')}}" method="post">
                    @csrf
                    <div class="modal-body semi-update-area">

                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary me-10" id="crud-form-submit-button">
                        <span class="indicator-label">
                            Save Changes
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(function() {
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
                            location.reload();
                        }
                        else{
                            toastr.error(d.msg);
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
        });
    </script>
    @if($program->created_by == Auth::user()->id)
<script>
        function openSemiUpdateModal(name,start,end,day,group){
            let id="{{$program->id}}";
            $.post( "{{route('exercise.library.getsemiupdatedata')}}", {
                'type' : name,
                'week_start': start ,
                'day': day ,
                'group': group ,
                'week_end': end ,
                'program_id' : id ,
                _token: '{{ csrf_token() }}',
                } ,function( data ) {
                        $('.semi-update-area').html(data);
                        $('#modal_name').html('Program Update');
                        $('#protien_calories_modal').modal("toggle");
                        $('.select-2-setup').select2();

            });
        }


    </script>

    @endif
@endsection
