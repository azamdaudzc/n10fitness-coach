<div class="program_builder_day_repeater" style="display: none">
    <div class="form-group">
        <div data-repeater-list="kt_program_repeater">
            <div data-repeater-item>
                <div class="mt-10 "></div>
                <div class="row">
                    <div class="col-10">
                        <select name="day_exercise" class="form-control mb-2 mb-md-0">
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
                                    <input type="number" name="exercise-sets-no" placeholder="Sets No"
                                        class="form-control">
                                </div>
                                <div class="col-6 mt-5">
                                    <input type="number" name="exercise-rep-min" placeholder="Rep Min"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <input type="number" name="exercise-rep-max" placeholder="Rep Max"
                                        class="form-control">
                                </div>
                                <div class="col-6 mt-5">
                                    <input type="number" name="exercise-rpe" placeholder="RPE" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-5">
                                    <input type="number" name="exercise-load" placeholder="Load" class="form-control">
                                </div>
                                <div class="col-6 mt-5">
                                    <input type="number" name="exercise-rest-time" placeholder="Rest Time"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                            <i class="la la-trash-o"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group mt-5">
        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
            <i class="la la-plus"></i>Add Exercise
        </a>
    </div>
</div>
