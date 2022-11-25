@extends('layouts.main-layout')

@section('template_title')
    Users
@endsection

@section('content')


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form action="{{ route('program.builder.store') }}" method="post">
                @csrf
                <div class="form-group row mb-10">
                    <div class="col-4">
                        <label for="program-name">Program Name</label>
                        <input type="text" id="program-name" name="program_name" placeholder="Name" class="form-control"
                            value="{{ $program->title }}">
                    </div>
                    <div class="col-4">
                        <label for="program-groups">Program Weeks</label>
                        <input type="number" id="program-groups" class="form-control" placeholder="Weeks"
                            value="{{ $program->weeks }}" disabled>
                    </div>
                    <div class="col-4">
                        <label for="program-days">Program Days</label>
                        <input type="number" id="program-days" class="form-control" placeholder="Days" min="1"
                            max="7" value="{{ $program->days }}" disabled>
                    </div>

                </div>
                <input type="hidden" name="group_counter" id="group-counter" value="{{ $week_group_count }}">

                <input type="hidden" name="program_id" value="{{ $program->id }}">

                <div class="accordion" id="kt_accordion_1">


                    <div class="accordion-item">
                        <h2 class="accordion-header" id="week_cal_pro_main">
                            <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#week_cal_pro" aria-expanded="false"
                                aria-controls="week_cal_pro">
                                Week Calories Protiens
                            </button>
                        </h2>
                        <div id="week_cal_pro" class="accordion-collapse collapse" aria-labelledby="week_cal_pro"
                            data-bs-parent="#week_cal_pro_main">
                            <div class="accordion-body">
                                <div class="row mt-2">
                                    <div class="col-4"></div>
                                    <div class="col-4"> <label for="">Calories</label></div>
                                    <div class="col-4"> <label for="">Proteins</label></div>
                                </div>

                                @foreach ($all_group_data as $item)
                                    <div class="row mt-2">
                                        <div class="col-4 mt-3"><label for="week-cal-pro{{ $item->week_no }}">Week
                                                {{ $item->week_no }}</label></div>
                                        <div class="col-4"> <input type="number" name="week-{{ $item->week_no }}-calories"
                                                class="form-control" value="{{ $item->assigned_calories }}"
                                                placeholder="Week Calories"></div>
                                        <div class="col-4"> <input type="number"
                                                name="week-{{ $item->week_no }}-proteins" class="form-control"
                                                value="{{ $item->assigned_proteins }}" placeholder="Week Proteins"></div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    @for ($i = 1; $i <= $week_group_count; $i++)
                        <div class="accordion mt-10" id="kt_accordion_group_{{ $i }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="kt_accordion_group_{{ $i }}_header_1">
                                    <button
                                        class="accordion-button fs-4 fw-semibold @if ($i != 1) collapsed @endif"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#kt_accordion_group_{{ $i }}_body_1"
                                        aria-expanded="true" aria-controls="kt_accordion_group_{{ $i }}_body_1">
                                        Group {{ $per_group_data[$i]->week_group }}


                                    </button>



                                </h2>
                                <input type="hidden" name="no_of_days" value="{{ $program->days }}">
                                <input type="hidden" name="no_of_weeks" value="{{ $program->weeks }}">

                                <!--begin::Accordion-->
                                <div id="kt_accordion_group_{{ $i }}_body_1"
                                    class="accordion-collapse @if ($i == 1) collapse show @else collapsing @endif"
                                    aria-labelledby="kt_accordion_group_{{ $i }}_header_1"
                                    data-bs-parent="#kt_accordion_group_{{ $i }}">
                                    <div class="accordion-body">
                                        <div class="row mb-10">
                                            <div class="col-12">

                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="">From Week</label>
                                                        <select name="group-{{ $i }}-from" id=""
                                                            class="form-control mb-2 mb-md-0">
                                                            @foreach ($all_group_data as $weeks)
                                                                <option value="{{ $weeks->week_no }}"
                                                                    @if ($week_group_range[$i]->StartFrom == $weeks->week_no) selected @endif>Week
                                                                    {{ $weeks->week_no }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="">To Week</label>
                                                        <select name="group-{{ $i }}-to" id=""
                                                            class="form-control mb-2 mb-md-0">
                                                            @foreach ($all_group_data as $weeks)
                                                                <option value="{{ $weeks->week_no }}"
                                                                    @if ($week_group_range[$i]->EndTo == $weeks->week_no) selected @endif>Week
                                                                    {{ $weeks->week_no }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-6">
                                            </div>

                                        </div>

                                        <div class="row">

                                            @for ($j = 1; $j <= $program->days; $j++)
                                                <div class="col-6 mt-10">
                                                    <!--begin::Accordion-->
                                                    <div class="accordion"
                                                        id="kt_accordion_w{{ $i }}_day_{{ $j }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="kt_accordion_w{{ $i }}_day_{{ $j }}_header_1">
                                                                <button
                                                                    class="accordion-button fs-4 fw-semibold  @if ($j != 1) collapsed @endif"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#kt_accordion_w{{ $i }}_day_{{ $j }}_body_1"
                                                                    aria-expanded="true"
                                                                    aria-controls="kt_accordion_w{{ $i }}_day_{{ $j }}_body_1">
                                                                    Day {{ $j }}
                                                                </button>
                                                            </h2>
                                                            <div id="kt_accordion_w{{ $i }}_day_{{ $j }}_body_1"
                                                                class="accordion-collapse @if ($j == 1) collapse show @else collapsing @endif"
                                                                aria-labelledby="kt_accordion_w{{ $i }}_day_{{ $j }}_header_1"
                                                                data-bs-parent="#kt_accordion_w{{ $i }}_day_{{ $j }}">
                                                                <div class="accordion-body">
                                                                    <select name="group-{{ $i }}-day-{{ $j }}-dayname"
                                                                        id="group-{{ $i }}-day-{{ $j }}-dayname"
                                                                        class="form-control mb-2 mb-md-0">
                                                                        <option value="">Select Day
                                                                        </option>
                                                                        <option value="monday" @if($day_title[$i][$j]=='monday') selected @endif>Monday</option>
                                                                        <option value="tuesday" @if($day_title[$i][$j]=='tuesday') selected @endif>Tuesday</option>
                                                                        <option value="wednesday" @if($day_title[$i][$j]=='wednesday') selected @endif>Wednesday</option>
                                                                        <option value="thursday" @if($day_title[$i][$j]=='thursday') selected @endif>Thursday</option>
                                                                        <option value="friday" @if($day_title[$i][$j]=='friday') selected @endif>Friday</option>
                                                                        <option value="saturday" @if($day_title[$i][$j]=='saturday') selected @endif>Saturday</option>
                                                                        <option value="sunday" @if($day_title[$i][$j]=='sunday') selected @endif>Sunday</option>
                                                                    </select>

                                                                    <select
                                                                        class="form-select form-select-solid select-2-setup"
                                                                        data-control="select2"
                                                                        data-close-on-select="false"
                                                                        data-placeholder="Select Warmup"
                                                                        data-allow-clear="true" multiple="multiple"
                                                                        name="group-{{ $i }}-day-{{ $j }}-warmup[]"
                                                                        id="group-{{ $i }}-day-{{ $j }}-warmup">
                                                                        <option></option>
                                                                        @foreach ($warmups as $w)
                                                                            <option value="{{ $w->id }}"
                                                                                @if (in_array($w->id, $selected_warmup_ids[$i][$j])) selected @endif>
                                                                                {{ $w->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <!--begin::Repeater-->
                                                                    <div id="program_builder_day_repeater"
                                                                        class="program_builder_day_repeater">
                                                                        <div class="form-group">
                                                                            <div
                                                                                data-repeater-list="kt_program_repeater_w_{{ $i }}_d_{{ $j }}">
                                                                                @foreach ($week_day_exercise_data[$i][$j] as $exercise)
                                                                                    <div data-repeater-item>
                                                                                        <div class="mt-10 "></div>
                                                                                        <div class="row">
                                                                                            <div class="col-10">
                                                                                                <select name="day_exercise"
                                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise"
                                                                                                    class="form-control mb-2 mb-md-0">
                                                                                                    <option value="">
                                                                                                        Select
                                                                                                        Exercise
                                                                                                    </option>
                                                                                                    @foreach ($exercises as $w)
                                                                                                        <option
                                                                                                            value="{{ $w->id }}"
                                                                                                            @if ($exercise->exercise_library_id == $w->id) selected @endif>
                                                                                                            {{ $w->name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>

                                                                                                <div>
                                                                                                    <div class="row">
                                                                                                        <div
                                                                                                            class="col-6 mt-5">
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                name="exercise-sets-no"
                                                                                                                id="group-{{ $i }}-day-{{ $j }}-exercise-1-sets-no"
                                                                                                                placeholder="Number Of Sets"
                                                                                                                class="form-control"
                                                                                                                value="{{ $week_day_exercise_set[$exercise->id]->set_no }}">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="col-6 mt-5">
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                name="exercise-rep-min"
                                                                                                                id="group-{{ $i }}-day-{{ $j }}-exercise-1-rep-min"
                                                                                                                placeholder="Rep Min"
                                                                                                                class="form-control"
                                                                                                                value="{{ $week_day_exercise_set[$exercise->id]->rep_min_no }}">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div
                                                                                                            class="col-6 mt-5">
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                name="exercise-rep-max"
                                                                                                                id="group-{{ $i }}-day-{{ $j }}-exercise-1-rep-max"
                                                                                                                placeholder="Rep Max"
                                                                                                                class="form-control"
                                                                                                                value="{{ $week_day_exercise_set[$exercise->id]->rep_max_no }}">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="col-6 mt-5">
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                name="exercise-rpe"
                                                                                                                id="group-{{ $i }}-day-{{ $j }}-exercise-1-rpe"
                                                                                                                placeholder="RPE"
                                                                                                                class="form-control"
                                                                                                                value="{{ $week_day_exercise_set[$exercise->id]->rpe_no }}">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div
                                                                                                            class="col-6 mt-5">
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                name="exercise-load"
                                                                                                                id="group-{{ $i }}-day-{{ $j }}-exercise-1-load"
                                                                                                                placeholder="Load"
                                                                                                                class="form-control"
                                                                                                                value="{{ $week_day_exercise_set[$exercise->id]->load_text }}">
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="col-6 mt-5">
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                name="exercise-rest-time"
                                                                                                                id="group-{{ $i }}-day-{{ $j }}-exercise-1-rest-time"
                                                                                                                placeholder="Rest Time"
                                                                                                                class="form-control"
                                                                                                                value="{{ $week_day_exercise_set[$exercise->id]->rest_time }}">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div
                                                                                                            class="col-12 mt-5">
                                                                                                            <label for="">Note:</label>
                                                                                                                <textarea name="exercise-notes" id="" cols="20" rows="2" class="form-control">{{ $week_day_exercise_set[$exercise->id]->notes }}</textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <a href="javascript:;"
                                                                                                    data-repeater-delete
                                                                                                    class="btn btn-sm btn-light-danger">
                                                                                                    <i
                                                                                                        class="la la-trash-o"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mt-5">
                                                                            <a href="javascript:;" data-repeater-create
                                                                                class="btn btn-light-primary">
                                                                                <i class="la la-plus"></i>Add Exercise
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Accordion-->
                                                </div>
                                            @endfor

                                        </div>

                                    </div>
                                    {{-- day card --}}

                                </div>

                            </div>
                        </div>

                    @endfor
                    <div class="box-footer mt-20">
                        <button type="submit" class="btn btn-primary me-10" id="crud-form-submit-button">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>

            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('.program_builder_day_repeater').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });



            $(document).on("submit", "form", function(event) {
                event.preventDefault();

                if ($('#program-name').val() == '') {
                    toastr.error('Program Name Cannot Be Empty');
                    return false;
                } else if ($('#program-groups').val() == '') {
                    toastr.error('Program Week Cannot Be Empty');
                    return false;
                } else if ($('#program-days').val() == '') {
                    toastr.error('Program Day Cannot Be Empty');
                    return false;
                }
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
                            window.location.href = "{{ route('program.builder.index') }}";

                        }
                        else{
                            toastr.error(d.msg.errorInfo);
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

        function loadForm() {

            let form_body = $('#program_builder_form');
            let name = $('#program-name').val();
            let weeks = $('#program-groups').val();
            let days = $('#program-days').val();
            $.post('{{ route('program.builder.details') }}', {
                _token: '{{ csrf_token() }}',
                name: name,
                weeks: weeks,
                days: days,
            }, function(d) {
                form_body.html(d);
                load_repeater();
            });
        }

        function load_repeater() {
            $('.program_builder_day_repeater').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        }
    </script>
@endsection
