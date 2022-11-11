@extends('layouts.main-layout')

@section('template_title')
    Users
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">

                <div class="card-body py-4">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <div class="card-body py-5">

                            <form method="POST" id="crud-form" action="{{ route('exercise.library.store') }}" role="form"
                                enctype="multipart/form-data">
                                @csrf
                                @if ($library)
                                    <input type="hidden" name="id" value="{{ $library->id }}">
                                @endif
                                <div class="fv-row mb-7">


                                    <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                                    <style>
                                        .image-input-placeholder {
                                            background-image:  url('{{ asset('assets/media/svg/files/blank-image-dark.svg') }}');
                                        }

                                        [data-theme="dark"] .image-input-placeholder {
                                            background-image:  url('{{ asset('assets/media/svg/files/blank-image-dark.svg') }}');
                                        }
                                    </style>
                                    <div class="image-input image-input-outline image-input-placeholder"
                                        data-kt-image-input="true">
                                        <div class="image-input-wrapper w-125px h-125px"
                                            @if ($library->avatar != null) style="background-image: url('{{  $library->avatar }}');"@else style="background-image: url('{{ asset('assets/media/svg/files/blank-image-dark.svg') }}')" @endif>
                                        </div>
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" id="imgInp" name="avatar"
                                                accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" id="avatar_removed" />
                                        </label>
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow remove-avatar"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>

                                </div>

                                <div class="mb-10">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" placeholder="Name" name="name" type="text"
                                        id="name" value="{{ @$library->name }}">
                                </div>

                                <div class="mb-10">
                                    <label for="video_link" class="form-label">Video Link</label>
                                    <input class="form-control" placeholder="Video Link" name="video_link" type="text"
                                        id="video_link" value="{{ $library->video_link }}">
                                </div>

                                <div class="mb-10">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select select-2-setup" data-control="select2"
                                        data-placeholder="Select A Category" name="category_id" id="category">
                                        <option></option>
                                        @foreach ($categories as $mp)
                                            <option value="{{ $mp->id }}"
                                                @if ($library->category_id == $mp->id) selected @endif>{{ $mp->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-10">
                                    <label for="equipment" class="form-label">Equipment</label>
                                    <select class="form-select select-2-setup" data-control="select2"
                                        data-placeholder="Select An Equipment" name="equipment_id" id="equipment">
                                        <option></option>
                                        @foreach ($equipments as $mp)
                                            <option value="{{ $mp->id }}"
                                                @if ($library->equipment_id == $mp->id) selected @endif>{{ $mp->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-10">
                                    <label for="movement_pattern" class="form-label">Movement Pattern</label>
                                    <select class="form-select select-2-setup" data-control="select2"
                                        data-placeholder="Select A Movement Pattern" name="movement_pattern_id"
                                        id="movement_pattern">
                                        <option></option>
                                        @foreach ($movement_patterns as $mp)
                                            <option value="{{ $mp->id }}"
                                                @if ($library->movement_pattern_id == $mp->id) selected @endif>{{ $mp->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-10">
                                    <label for="top_three_cues" class="form-label">Top Three Cues</label>
                                    <input class="form-control" placeholder="Top Three Cues" name="top_three_cues"
                                        type="text" id="top_three_cues" value="{{ $library->top_three_cues }}">
                                </div>
                                <div class="mb-10">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" placeholder="Description" name="description" type="text"
                                        id="description" >{{ $library->description }}</textarea>
                                </div>



                                <!--begin::Repeater-->
                                <div id="kt_docs_repeater_basic">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <h5>Muscles</h5>
                                        <div data-repeater-list="kt_docs_repeater_basic">
                                            @foreach ($library_muscles as $lm )
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="form-label"></label>

                                                            <select  class="form-control mb-2 mb-md-0"   name="musclename" id="">
                                                               <option value="">Select Type</option>
                                                                <option value="Primary Muscle" @if($lm->name=='Primary Muscle') selected @endif>Primary Muscle</option>
                                                                <option value="Secondary Muscle" @if($lm->name=='Secondary Muscle') selected @endif>Secondary Muscle</option>
                                                                <option value="Accessory Muscle" @if($lm->name=='Accessory Muscle') selected @endif>Accessory Muscle</option>
                                                            </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label"></label>
                                                            <select  class="form-control mb-2 mb-md-0"   name="muscleid" id=""  >
                                                               <option value="">Select Muscle</option>
                                                               @foreach($muscles as $m)
                                                               <option value="{{$m->id}}" @if($lm->excercise_muscle_id==$m->id) selected @endif>{{$m->name}}</option>
                                                               @endforeach
                                                            </select>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="la la-trash-o"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @if($library_muscles->count()>0)
                                            @else
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label class="form-label"></label>

                                                            <select  class="form-control mb-2 mb-md-0"   name="musclename" id="">
                                                               <option value="">Select Type</option>
                                                                <option value="Primary Muscle">Primary Muscle</option>
                                                                <option value="Secondary Muscle">Secondary Muscle</option>
                                                                <option value="Accessory Muscle">Accessory Muscle</option>
                                                            </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label"></label>
                                                            <select  class="form-control mb-2 mb-md-0"   name="muscleid" id=""  >
                                                               <option value="">Select Muscle</option>
                                                               @foreach($muscles as $m)
                                                               <option value="{{$m->id}}">{{$m->name}}</option>
                                                               @endforeach
                                                            </select>
                                                    </div>

                                                    <div class="col-md-4">
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
                                <div class="box-footer mt-13">
                                    <button type="submit" class="btn btn-primary me-10" id="crud-form-submit-button">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_drawer_example_basic" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
        data-kt-drawer-toggle=".create_new_off_canvas_modal" data-kt-drawer-close="#kt_drawer_example_basic_close"
        data-kt-drawer-width="500px">
        <div class="py-5 col-12 p-1">
            <div id="subdiv_kt_drawer_example_basic"></div>
        </div>
    </div>
@endsection


@section('scripts')
<script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>

    <script type="text/javascript">
        $(function() {
            $('body').on('click', '.remove-avatar-button', function() {
                $('#imgInp').val('');
                $('#avatar_removed').val(1)
                $('.image-input-wrapper').css('background-image', "url('{{asset('assets/media/svg/files/blank-image-dark.svg')}}')");
            });
            $('.select-2-setup').select2();

            $('#search_table').on('keyup', function() {
                table.search($(this).val()).draw();
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
                        console.log(d);
                        if (d.success == true) {
                            toastr.success(d.msg);
                            window.location.href="{{route('exercise.library.index')}}";
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

            $('body').on('change', '#imgInp', function() {
                let input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.image-input-wrapper').css('background-image', "url(" + e.target.result +
                            ")");
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });


            $('#kt_docs_repeater_basic').repeater();

        });
    </script>
@endsection
