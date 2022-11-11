@extends('layouts.main-layout')

@section('template_title')
    Users
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body py-5">

            <form method="POST" id="crud-form" action="{{ route('warmup.builder.store') }}" role="form"
                enctype="multipart/form-data">
                @csrf
                @if ($data)
                    <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                <div class="mb-10">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" placeholder="name" name="name" type="text" id="question"
                        value="{{ @$data->name }}">
                </div>

                <div class="mb-10">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" placeholder="description" name="description" type="text"
                        id="description" >{{ @$data->description }}</textarea>
                </div>

                <div class="mb-10">
                    <label for="instruction" class="form-label">Instruction</label>
                    <textarea class="form-control" placeholder="instruction" name="instructions" type="text"
                        id="instruction" >{{ @$data->instructions }}</textarea>
                </div>

                <!--begin::Repeater-->
                <div id="kt_docs_repeater_basic">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_basic">
                            @foreach ($warmupvideos as $wv)
                            <div data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="form-label">Video Url:</label>
                                        <input type="text" name="video_url" class="form-control mb-2 mb-md-0"
                                            placeholder="Video Url" value="{{$wv->video_url}}" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Thumbnail:</label>
                                        <input type="file" name="thumbnail" class="form-control mb-2 mb-md-0 imgInp"
                                            placeholder="Thumbnail" value="{{$wv->thumbnail}}" />
                                        <input type="hidden" value="{{$wv->thumbnail}}" name="old_thumbnail">
                                    </div>
                                    <div class="col-md-2">
                                        <img @if($wv->thumbnail ==null)src="{{asset('assets/media/sample/image-area.jpg')}}" @else src="{{$wv->thumbnail}}" @endif  class=" mt-3 thumbnail-image " />

                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:;" data-repeater-delete
                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="la la-trash-o"></i>Delete
                                        </a>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                            @if(!$warmupvideos->count()>0)

                            <div data-repeater-item>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label class="form-label">Video Url:</label>
                                        <input type="text" name="video_url" class="form-control mb-2 mb-md-0"
                                            placeholder="Video Url" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Thumbnail:</label>
                                        <input type="file" name="thumbnail" class="form-control mb-2 mb-md-0 imgInp"
                                            placeholder="Thumbnail" />
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{asset('assets/media/sample/image-area.jpg')}}"  class=" mt-3 thumbnail-image " />

                                    </div>

                                    <div class="col-md-3">
                                        <a href="javascript:;" data-repeater-delete
                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="la la-trash-o"></i>Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group mt-5">
                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                            <i class="la la-plus"></i>Add
                        </a>
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->


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
                            window.location.href = "{{ route('warmup.builder.index') }}";

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
