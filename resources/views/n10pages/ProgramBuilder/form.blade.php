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
                    <div class="col-3">
                        <label for="program-name">Program Name</label>
                        <input type="text" id="program-name" name="program_name" placeholder="Name" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="program-weeks">Program Weeks</label>
                        <input type="number" id="program-weeks" name="no_of_weeks" class="form-control"
                            placeholder="Weeks">
                    </div>
                    <div class="col-3">
                        <label for="program-days">Program Days</label>
                        <input type="number" id="program-days" name="no_of_days" class="form-control" placeholder="Days"
                            min="1" max="7">
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary mt-6" onclick="loadForm(event)">Generate</button>
                    </div>
                </div>

                <div class="generate-programform" id="program_builder_form">
                </div>
                <div class="col-3">
                    <button class="btn btn-primary mt-6" onclick="addGroup(event)" style="display: none"
                        id="add-group-button">Add Group</button>
                </div>

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
                <input type="hidden" name="group_counter" id="group-counter" value="2">

            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript">
        $(function() {




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



        function loadForm(e) {
            e.preventDefault();
            let form_body = $('#program_builder_form');
            let name = $('#program-name').val();
            let weeks = $('#program-weeks').val();
            let days = $('#program-days').val();
            if (days > 7) {

                toastr.error("Days Cannot Be Greater Then 7");
                return false;
            }
            $.post('{{ route('program.builder.details') }}', {
                _token: '{{ csrf_token() }}',
                name: name,
                weeks: weeks,
                days: days,
            }, function(d) {
                //loadRepeater(e);
                form_body.html(d);
                load_repeater(".program_builder_day_repeater_1");
                $('.select-2-setup').select2();

                $('#add-group-button').show();
                $('#program-name').attr('readonly', 'readonly');
                $('#program-weeks').attr('readonly', 'readonly');
                $('#program-days').attr('readonly', 'readonly');
            });
        }

        function addGroup(e) {
            e.preventDefault();
            let form_body = $('#program_builder_form');
            let counter = $('#group-counter').val();
            let name = $('#program-name').val();
            let weeks = $('#program-weeks').val();
            let days = $('#program-days').val();
            $.post('{{ route('program.builder.details') }}', {
                _token: '{{ csrf_token() }}',
                counter: counter,
                name: name,
                weeks: weeks,
                days: days,
            }, function(d) {
                form_body.append(d);
                load_repeater(".program_builder_day_repeater_"+counter);
                $('.select-2-setup').select2();

                $('#group-counter').val(parseInt(counter) + 1);
            });
        }

        function load_repeater(className) {
            $(className).repeater({
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
