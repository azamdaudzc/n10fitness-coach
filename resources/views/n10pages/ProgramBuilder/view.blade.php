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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                            <i class="fa fa-edit"></i>
                        </button>
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
                                        <button type="button" class="" onclick="startCaloriesProteins('{{$week_group_range[$i]->StartFrom}}','{{$week_group_range[$i]->EndTo}}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
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
                                        <h3 class="card-title">Day {{ $j }}</h3>
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
                                                {{ $week_day_exercise_set[$exercise->id]->notes }}
                                            </div>

                                            <div class="table-responsive ">
                                                <table class="table-bordered program-table">
                                                    <thead>
                                                        <tr>
                                                            <td>#</td>
                                                            <td>Sets
                                                            </td>
                                                            <td>Reps
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
                                                                <td>{{ $week_day_exercise_set[$exercise->id]->set_no }}
                                                                </td>
                                                                <td>{{ $week_day_exercise_set[$exercise->id]->rep_min_no }}/{{ $week_day_exercise_set[$exercise->id]->rep_max_no }}
                                                                </td>
                                                                <td>{{ $week_day_exercise_set[$exercise->id]->rpe_no }}
                                                                </td>
                                                                <td>{{ $week_day_exercise_set[$exercise->id]->load_text }}
                                                                </td>
                                                                <td> {{ $week_day_exercise_set[$exercise->id]->rest_time }}
                                                                </td>
                                                            </tr>
                                                        @endfor

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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

    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Record</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <label for="new_program_name"><strong>Program Name</strong></label>
                    <input type="text" id="new_program_name" class="form-control" name="new_program_name">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="updateName()" class="btn btn-primary me-10" id="crud-form-submit-button">
                        <span class="indicator-label">
                            Save Changes
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="protien_calories_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Calories & Proteins</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body calories-protien-update-area">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="updateCaloriesProteins()" class="btn btn-primary me-10" id="crud-form-submit-button">
                        <span class="indicator-label">
                            Save Changes
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(function() {});

        function updateName(){
            let new_name=$('#new_program_name').val();
            if(new_name==null || new_name == ''){
                toastr.error("Name Cannot Be Null");
                return false;
            }
            $('#crud-form-submit-button').attr("data-kt-indicator", "on");
            let id="{{$program->id}}";
            $.post( "{{route('exercise.library.semiupdate')}}", {
                'name': new_name ,
                'update_type' : 'name' ,
                'program_id' : id ,
                _token: '{{ csrf_token() }}',
                } ,function( data ) {
                $('#crud-form-submit-button').attr("data-kt-indicator", "off");
                if (data.success == true) {
                        toastr.success(data.msg);
                        location.reload();
                    }
                    else{
                        toastr.success(data.msg);
                    }
            });
        }

        function updateCaloriesProteins(){
            let new_name=$('#new_program_name').val();
            if(new_name==null || new_name == ''){
                toastr.error("Name Cannot Be Null");
                return false;
            }
            $('#crud-form-submit-button').attr("data-kt-indicator", "on");
            let id="{{$program->id}}";
            $.post( "{{route('exercise.library.semiupdate')}}", {
                'name': new_name ,
                'update_type' : 'name' ,
                'program_id' : id ,
                _token: '{{ csrf_token() }}',
                } ,function( data ) {
                $('#crud-form-submit-button').attr("data-kt-indicator", "off");
                if (data.success == true) {
                        toastr.success(data.msg);
                        location.reload();
                    }
                    else{
                        toastr.error(data.msg);
                    }
            });
        }

        function startCaloriesProteins(start,end){
            let id="{{$program->id}}";
            $.post( "{{route('exercise.library.getsemiupdatedata')}}", {
                'type' : 'calories_proteins',
                'week_start': start ,
                'week_end': end ,
                'program_id' : id ,
                _token: '{{ csrf_token() }}',
                } ,function( data ) {
                        $('.calories-protien-update-area').html(data);
                        $('#protien_calories_modal').modal("toggle");
            });
        }
    </script>
@endsection
