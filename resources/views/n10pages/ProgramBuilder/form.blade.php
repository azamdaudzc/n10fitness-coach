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
                    <input type="text" id="program-days" class="form-control" placeholder="Days" min="1"
                        max="7">
                </div>
                <div class="col-3">
                    <button class="btn btn-primary mt-6" onclick="loadForm()">Generate</button>
                </div>
            </div>
            <form action="{{ route('program.builder.store') }}" method="post">
                @csrf
                <div class="generate-programform" id="program_builder_form">
                </div>
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
