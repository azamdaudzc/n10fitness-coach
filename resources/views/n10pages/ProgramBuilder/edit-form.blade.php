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
                        <label for="program-weeks">Program Weeks</label>
                        <input type="number" id="program-weeks" class="form-control" placeholder="Weeks"
                            value="{{ $program->weeks }}" disabled>
                    </div>
                    <div class="col-4">
                        <label for="program-days">Program Days</label>
                        <input type="number" id="program-days" class="form-control" placeholder="Days" min="1"
                            max="7" value="{{ $program->days }}" disabled>
                    </div>

                </div>

                <input type="hidden" name="program_id" value="{{ $program->id }}">
                @for ($i = 1; $i <= $program->weeks; $i++)
                    <div class="accordion mt-10" id="kt_accordion_week_{{ $i }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="kt_accordion_week_{{ $i }}_header_1">
                                <button
                                    class="accordion-button fs-4 fw-semibold @if ($i != 1) collapsed @endif"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#kt_accordion_week_{{ $i }}_body_1" aria-expanded="true"
                                    aria-controls="kt_accordion_week_{{ $i }}_body_1">
                                    Week {{ $i }}
                                </button>

                            </h2>
                            <input type="hidden" name="no_of_days" value="{{ $program->days }}">
                            <input type="hidden" name="no_of_weeks" value="{{ $program->weeks }}">

                            <!--begin::Accordion-->
                            <div id="kt_accordion_week_{{ $i }}_body_1"
                                class="accordion-collapse @if ($i == 1) collapse show @else collapsing @endif"
                                aria-labelledby="kt_accordion_week_{{ $i }}_header_1"
                                data-bs-parent="#kt_accordion_week_{{ $i }}">
                                <div class="accordion-body">
                                    <div class="row mb-10">

                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="week-{{ $i }}-proteins">Proteins</label>
                                                    <input type="number" name="week-{{ $i }}-proteins"
                                                        id="week-{{ $i }}-proteins" placeholder="Proteins"
                                                        class="form-control"
                                                        value="{{ $per_week_data[$i]->assigned_proteins }}">
                                                </div>
                                                <div class="col-6">
                                                    <label for="week-{{ $i }}-calories">Calories</label>
                                                    <input type="number" name="week-{{ $i }}-calories"
                                                        id="week-{{ $i }}-calories" placeholder="Calories"
                                                        class="form-control"
                                                        value="{{ $per_week_data[$i]->assigned_calories }}">
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
                                                                <select
                                                                    name="week-{{ $i }}-day-{{ $j }}-warmup"
                                                                    id="week-{{ $i }}-day-{{ $j }}-warmup"
                                                                    class="form-control mb-2 mb-md-0">
                                                                    <option value="">Select Warmup</option>
                                                                    @foreach ($warmups as $w)
                                                                        <option value="{{ $w->id }}"
                                                                            @if ($week_day_warmup_data[$i][$j]->first()->warmup_builder_id == $w->id) selected @endif>
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
                                                                                                id="week-{{ $i }}-day-{{ $j }}-exercise"
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
                                                                                                            id="week-{{ $i }}-day-{{ $j }}-exercise-1-sets-no"
                                                                                                            placeholder="Sets No"
                                                                                                            class="form-control"
                                                                                                            value="{{ $week_day_exercise_set[$exercise->id]->set_no }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="col-6 mt-5">
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            name="exercise-rep-min"
                                                                                                            id="week-{{ $i }}-day-{{ $j }}-exercise-1-rep-min"
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
                                                                                                            id="week-{{ $i }}-day-{{ $j }}-exercise-1-rep-max"
                                                                                                            placeholder="Rep Max"
                                                                                                            class="form-control"
                                                                                                            value="{{ $week_day_exercise_set[$exercise->id]->rep_max_no }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="col-6 mt-5">
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            name="exercise-rpe"
                                                                                                            id="week-{{ $i }}-day-{{ $j }}-exercise-1-rpe"
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
                                                                                                            id="week-{{ $i }}-day-{{ $j }}-exercise-1-load"
                                                                                                            placeholder="Load"
                                                                                                            class="form-control"
                                                                                                            value="{{ $week_day_exercise_set[$exercise->id]->load_text }}">
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="col-6 mt-5">
                                                                                                        <input
                                                                                                            type="number"
                                                                                                            name="exercise-rest-time"
                                                                                                            id="week-{{ $i }}-day-{{ $j }}-exercise-1-rest-time"
                                                                                                            placeholder="Rest Time"
                                                                                                            class="form-control"
                                                                                                            value="{{ $week_day_exercise_set[$exercise->id]->rest_time }}">
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
                } else if ($('#program-weeks').val() == '') {
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
            let weeks = $('#program-weeks').val();
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
