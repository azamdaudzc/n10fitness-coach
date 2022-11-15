  @for ($i = 1; $i <= $weeks; $i++)
      <div class="accordion mt-10" id="kt_accordion_week_{{ $i }}">
          <div class="accordion-item">
              <h2 class="accordion-header" id="kt_accordion_week_{{ $i }}_header_1">
                  <button class="accordion-button fs-4 fw-semibold @if ($i != 1) collapsed @endif"
                      type="button" data-bs-toggle="collapse"
                      data-bs-target="#kt_accordion_week_{{ $i }}_body_1" aria-expanded="true"
                      aria-controls="kt_accordion_week_{{ $i }}_body_1">
                      Week {{ $i }}
                  </button>

              </h2>

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
                                          class="form-control">
                                  </div>
                                  <div class="col-6">
                                      <label for="week-{{ $i }}-calories">Calories</label>
                                      <input type="number" name="week-{{ $i }}-calories"
                                          id="week-{{ $i }}-calories" placeholder="Calories"
                                          class="form-control">
                                  </div>

                              </div>
                          </div>
                          <div class="col-6">
                          </div>

                      </div>

                      <div class="row">

                          @for ($j = 1; $j <= $days; $j++)

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
                                                          <option value="{{ $w->id }}">{{ $w->name }}
                                                          </option>
                                                      @endforeach
                                                  </select>
                                                  <!--begin::Repeater-->
                                                  <div id="program_builder_day_repeater"
                                                      class="program_builder_day_repeater">
                                                      <div class="form-group">
                                                          <div
                                                              data-repeater-list="kt_program_repeater_w_{{ $i }}_d_{{ $j }}">
                                                              <div data-repeater-item>
                                                                  <div class="mt-10 "></div>
                                                                  <div class="row">
                                                                      <div class="col-10">
                                                                          <select name="day_exercise"
                                                                              id="week-{{ $i }}-day-{{ $j }}-exercise"
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
                                                                                          id="week-{{ $i }}-day-{{ $j }}-exercise-1-sets-no"
                                                                                          placeholder="Sets No"
                                                                                          class="form-control">
                                                                                  </div>
                                                                                  <div class="col-6 mt-5">
                                                                                      <input type="number"
                                                                                          name="exercise-rep-min"
                                                                                          id="week-{{ $i }}-day-{{ $j }}-exercise-1-rep-min"
                                                                                          placeholder="Rep Min"
                                                                                          class="form-control">
                                                                                  </div>
                                                                              </div>
                                                                              <div class="row">
                                                                                  <div class="col-6 mt-5">
                                                                                      <input type="number"
                                                                                          name="exercise-rep-max"
                                                                                          id="week-{{ $i }}-day-{{ $j }}-exercise-1-rep-max"
                                                                                          placeholder="Rep Max"
                                                                                          class="form-control">
                                                                                  </div>
                                                                                  <div class="col-6 mt-5">
                                                                                      <input type="number"
                                                                                          name="exercise-rpe"
                                                                                          id="week-{{ $i }}-day-{{ $j }}-exercise-1-rpe"
                                                                                          placeholder="RPE"
                                                                                          class="form-control">
                                                                                  </div>
                                                                              </div>
                                                                              <div class="row">
                                                                                  <div class="col-6 mt-5">
                                                                                      <input type="number"
                                                                                          name="exercise-load"
                                                                                          id="week-{{ $i }}-day-{{ $j }}-exercise-1-load"
                                                                                          placeholder="Load"
                                                                                          class="form-control">
                                                                                  </div>
                                                                                  <div class="col-6 mt-5">
                                                                                      <input type="number"
                                                                                          name="exercise-rest-time"
                                                                                          id="week-{{ $i }}-day-{{ $j }}-exercise-1-rest-time"
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
