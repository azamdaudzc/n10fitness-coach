@php
    $i = $counter;
@endphp

<!--begin::Accordion-->
@if ($add_group == 1)
    <div class="accordion" id="kt_accordion_1">
        <div class="accordion-item">
            <h2 class="accordion-header" id="week_cal_pro_main">
                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#week_cal_pro" aria-expanded="false" aria-controls="week_cal_pro">
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
                    @for ($j = 1; $j <= $weeks; $j++)
                        <div class="row mt-2">
                            <div class="col-4 mt-3"><label for="week-cal-pro{{ $j }}">Week
                                    {{ $j }}</label></div>
                            <div class="col-4"> <input type="number" name="week-{{ $j }}-calories"
                                    class="form-control" placeholder="Week Calories"></div>
                            <div class="col-4"> <input type="number" name="week-{{ $j }}-proteins"
                                    class="form-control" placeholder="Week Proteins"></div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
@endif

<!--end::Accordion-->
<div class="accordion mt-10" id="kt_accordion_group_{{ $i }}">
    <div class="accordion-item">
        <h2 class="accordion-header" id="kt_accordion_group_{{ $i }}_header_1">
            <button class="accordion-button fs-4 fw-semibold @if ($i != 1) collapsed @endif"
                type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_group_{{ $i }}_body_1"
                aria-expanded="true" aria-controls="kt_accordion_group_{{ $i }}_body_1">
                Group {{ $i }}
            </button>

        </h2>

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
                                    <option value="">From Week</option>
                                    @for ($k = 1; $k <= $weeks; $k++)
                                        <option value="{{ $k }}">Week {{ $k }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">To Week</label>
                                <select name="group-{{ $i }}-to" id=""
                                    class="form-control mb-2 mb-md-0">
                                    <option value="">To Week</option>
                                    @for ($k = 1; $k <= $weeks; $k++)
                                        <option value="{{ $k }}">Week {{ $k }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    @for ($j = 1; $j <= $days; $j++)

                        <div class="col-6 mt-10">
                            <!--begin::Accordion-->
                            <div class="accordion" id="kt_accordion_w{{ $i }}_day_{{ $j }}">
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
                                            <option value="monday">Monday</option>
                                            <option value="tuesday">Tuesday</option>
                                            <option value="wednesday">Wednesday</option>
                                            <option value="thursday">Thursday</option>
                                            <option value="friday">Friday</option>
                                            <option value="saturday">Saturday</option>
                                            <option value="sunday">Sunday</option>
                                        </select>

                                            <select class="form-select form-select-solid select-2-setup mt-2"
                                                data-control="select2" data-close-on-select="false"
                                                data-placeholder="Select Warmup" data-allow-clear="true"
                                                multiple="multiple"
                                                name="group-{{ $i }}-day-{{ $j }}-warmup[]"
                                                id="group-{{ $i }}-day-{{ $j }}-warmup">
                                                <option></option>
                                                @foreach ($warmups as $w)
                                                    <option value="{{ $w->id }}">{{ $w->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <!--begin::Repeater-->
                                            <div class="program_builder_day_repeater_{{$i}}">
                                                <div class="form-group">
                                                    <div
                                                        data-repeater-list="kt_program_repeater_w_{{ $i }}_d_{{ $j }}">
                                                        <div data-repeater-item>
                                                            <div class="mt-10 "></div>
                                                            <div class="row">
                                                                <div class="col-10">
                                                                    <select name="day_exercise"
                                                                        id="group-{{ $i }}-day-{{ $j }}-exercise"
                                                                        class="form-control mb-2 mb-md-0">
                                                                        <option value="">Select Exercise
                                                                        </option>
                                                                        @foreach ($exercises as $w)
                                                                            <option value="{{ $w->id }}">
                                                                                {{ $w->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <div>
                                                                        <div class="row">
                                                                            <div class="col-6 mt-5">
                                                                                <input type="number"
                                                                                    name="exercise-sets-no"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-sets-no"
                                                                                    placeholder="Num Of Sets"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-6 mt-5">
                                                                                <input type="number"
                                                                                    name="exercise-rpe"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-rpe"
                                                                                    placeholder="RPE"
                                                                                    min="5"
                                                                                    max="10"
                                                                                    step="0.1"
                                                                                    class="form-control">
                                                                            </div>

                                                                        </div>
                                                                        <div class="row">

                                                                            <div class="col-6 mt-5">
                                                                                <input type="number"
                                                                                    name="exercise-rep-min"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-rep-min"
                                                                                    placeholder="Rep Min"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-6 mt-5">
                                                                                <input type="number"
                                                                                    name="exercise-rep-max"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-rep-max"
                                                                                    placeholder="Rep Max"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-6 mt-5">
                                                                                <input type="text"
                                                                                    name="exercise-load"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-load"
                                                                                    placeholder="Load"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-6 mt-5">
                                                                                <input type="text"
                                                                                    name="exercise-rest-time"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-rest-time"
                                                                                    placeholder="Rest Time"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12 mt-5">
                                                                                <label for="">Note:</label>
                                                                                <textarea name="exercise-notes" id="" cols="20" rows="2" class="form-control"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a href="javascript:;" data-repeater-delete
                                                                        class="btn btn-sm btn-light-danger">
                                                                        <i class="la la-trash-o"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
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
            <form method="POST" id="crud-form" action="{{ route('program.builder.store') }}" role="form"
                enctype="multipart/form-data">
                @csrf
                @if ($data)
                    <input type="hidden" name="id" value="{{ $data->id }}">
                @endif
                <div class="error-area"></div>
            </form>
        </div>
    </div>
</div>
</div>
