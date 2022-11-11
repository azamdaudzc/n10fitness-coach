@extends('layouts.main-layout')

@section('template_title')
    Users
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="form-group row mb-10">
            <div class="col-3">
                <label for="program-name">Program Name</label>
                <input type="text" id="program-name" placeholder="Name" class="form-control">
            </div>
            <div class="col-3">
                <label for="program-weeks">Program Weeks</label>
                <input type="text" id="program-weeks" class="form-control" placeholder="Weeks">
            </div>
            <div class="col-3">
                <label for="program-days">Program Days</label>
                <input type="text" id="program-days" class="form-control" placeholder="Days">
            </div>
            <div class="col-3">
                <button class="btn btn-primary mt-6" onclick="">Generate</button>
            </div>
        </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Week 1</h3>
            <div class="col-md-6 float-right mt-4">
            <div class="row">
                <div class="col-6">
                    <input type="text" name="proteins" id="week-1-proteins" placeholder="Proteins" class="form-control">
                </div>
                <div class="col-6">
                    <input type="text" name="calories" id="week-1-calories" placeholder="Calories" class="form-control">
                </div>
            </div>
            </div>
        </div>
        <div class="card-body py-5">
            {{-- day card --}}
           <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Day 1</h3>
                            <div class="col-md-6 float-right mt-4">
                            </div>
                        </div>
                        <div class="card-body py-5">
                            <select name="week-1-day-1-warmup" id="week-1-day-1-warmup" class="form-select select-2-setup" data-control="select2" data-placeholder="Select Warmup">
                                <option></option>
                                @foreach($warmups as $w)
                                    <option value="{{$w->id}}">{{$w->name}}</option>
                                @endforeach
                            </select>

                            <select name="week-1-day-1-exercise" id="week-1-day-1-exercise" class="form-select select-2-setup" data-control="select2" data-placeholder="Select Exercise">
                                <option></option>
                                @foreach($exercises as $w)
                                    <option value="{{$w->id}}">{{$w->name}}</option>
                                @endforeach
                            </select>

                            <div>
                                <input type="number" name="week-1-day-1-exercise-1-sets-no" id="week-1-day-1-exercise-1-sets-no" placeholder="Sets No" class="form-control">
                                <input type="number" name="week-1-day-1-exercise-1-rep-min" id="week-1-day-1-exercise-1-rep-min" placeholder="Rep Min" class="form-control">
                                <input type="number" name="week-1-day-1-exercise-1-rep-max" id="week-1-day-1-exercise-1-rep-max" placeholder="Rep Max" class="form-control">
                                <input type="number" name="week-1-day-1-exercise-1-rpe" id="week-1-day-1-exercise-1-rpe" placeholder="RPE" class="form-control">
                                <input type="number" name="week-1-day-1-exercise-1-load" id="week-1-day-1-exercise-1-load" placeholder="Load" class="form-control">
                                <input type="number" name="week-1-day-1-exercise-1-rest-time" id="week-1-day-1-exercise-1-rest-time" placeholder="Rest Time" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Day 2</h3>
                            <div class="col-md-6 float-right mt-4">
                            </div>
                        </div>
                        <div class="card-body py-5">


                        </div>
                    </div>
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
    </div>
</div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            $('#kt_docs_repeater_basic').repeater({
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
            $('.select-2-setup').select2();


            $('body').on('change', '.imgInp', function() {
                let input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(input).parent().parent().find('.thumbnail-image').attr("src",  e.target.result );
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
@endsection
