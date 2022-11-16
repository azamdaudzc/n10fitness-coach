@php
    $i = $counter;
@endphp
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
                    <div class="col-6">

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
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6">
                                <label for="group-{{ $i }}-proteins">Proteins</label>
                                <input type="number" name="group-{{ $i }}-proteins"
                                    id="group-{{ $i }}-proteins" placeholder="Proteins"
                                    class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="group-{{ $i }}-calories">Calories</label>
                                <input type="number" name="group-{{ $i }}-calories"
                                    id="group-{{ $i }}-calories" placeholder="Calories"
                                    class="form-control">
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
                                            <select name="group-{{ $i }}-day-{{ $j }}-warmup"
                                                id="group-{{ $i }}-day-{{ $j }}-warmup"
                                                class="form-control mb-2 mb-md-0">
                                                <option value="">Select Warmup</option>
                                                @foreach ($warmups as $w)
                                                    <option value="{{ $w->id }}">{{ $w->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <!--begin::Repeater-->
                                            <div class="program_builder_day_repeater">
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
                                                                                    placeholder="Sets No"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-6 mt-5">
                                                                                <input type="number"
                                                                                    name="exercise-rep-min"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-rep-min"
                                                                                    placeholder="Rep Min"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-6 mt-5">
                                                                                <input type="number"
                                                                                    name="exercise-rep-max"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-rep-max"
                                                                                    placeholder="Rep Max"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-6 mt-5">
                                                                                <input type="number"
                                                                                    name="exercise-rpe"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-rpe"
                                                                                    placeholder="RPE"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-6 mt-5">
                                                                                <input type="number"
                                                                                    name="exercise-load"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-load"
                                                                                    placeholder="Load"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-6 mt-5">
                                                                                <input type="number"
                                                                                    name="exercise-rest-time"
                                                                                    id="group-{{ $i }}-day-{{ $j }}-exercise-1-rest-time"
                                                                                    placeholder="Rest Time"
                                                                                    class="form-control">
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
