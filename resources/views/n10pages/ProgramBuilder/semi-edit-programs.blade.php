
@if($type=='calories_proteins')
<div class="accordion-body">
    <div class="row mt-2">
        <div class="col-4"></div>
        <div class="col-4"> <label for="">Calories</label></div>
        <div class="col-4"> <label for="">Proteins</label></div>
    </div>
    <input type="hidden"  name="update_type" value="calories_proteins">
    <input type="hidden" name="program_id" value="{{$program_id}}">
    <input type="hidden" name="week_start" value="{{$week_start}}">
    <input type="hidden" name="week_end" value="{{$week_end}}">
    @for ($j = $week_start; $j <= $week_end; $j++)
        <div class="row mt-2">
            <div class="col-4 mt-3"><label for="week-cal-pro{{ $j }}">Week
                    {{ $j }}</label></div>
            <div class="col-4"> <input type="number" name="week-{{ $j }}-calories"
                    class="form-control" placeholder="Week Calories"></div>
            <div class="col-4"> <input type="number" name="week-{{ $j }}-proteins"
                    class="form-control" placeholder="Week Proteins"></div>
        </div>
    @endfor
@elseif($type=='program_name')
    <label for="new_program_name"><strong>Program Name</strong></label>
    <input type="text" id="new_program_name" class="form-control" name="new_program_name">
    <input type="hidden" name="update_type" value="program_name">
    <input type="hidden" name="program_id" value="{{$program_id}}">

@elseif($type=='program_day_edit')
<input type="hidden" name="update_type" value="program_day_edit">
<input type="hidden" name="program_id" value="{{$program_id}}">
<input type="hidden" name="selected_day" value="{{$day}}">
<input type="hidden" name="week_start" value="{{$week_start}}">
<input type="hidden" name="week_end" value="{{$week_end}}">
<input type="hidden" name="group" value="{{$group}}">
<div class="program-sub-area col-md-12">
    <div class="card shadow-sm ">
        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
            <h3 class="card-title">Day {{ $day }}</h3>

        </div>
            <div class="card-body">
                <label for="" >Select Day</label>
                <select name="new_dayname"

                    class="form-control mb-2 mb-md-0">
                    <option value="">Select Day
                    </option>
                    <option value="monday" @if($day_title=='monday') selected @endif>Monday</option>
                    <option value="tuesday" @if($day_title=='tuesday') selected @endif>Tuesday</option>
                    <option value="wednesday" @if($day_title=='wednesday') selected @endif>Wednesday</option>
                    <option value="thursday" @if($day_title=='thursday') selected @endif>Thursday</option>
                    <option value="friday" @if($day_title=='friday') selected @endif>Friday</option>
                    <option value="saturday" @if($day_title=='saturday') selected @endif>Saturday</option>
                    <option value="sunday" @if($day_title=='sunday') selected @endif>Sunday</option>
                </select>
    <div class="mt-2"><Strong>Warmups :</Strong> <br>

    <select
    class="form-select form-select-solid select-2-setup"
    data-control="select2"
    data-close-on-select="false"
    data-placeholder="Select Warmup"
    data-allow-clear="true" multiple="multiple"
    name="new_warmups[]"
    id="warmup">
    <option></option>
    @foreach ($all_warmups as $w)
        <option value="{{ $w->id }}"
            @if (in_array($w->id, $selected_warmups)) selected @endif>
            {{ $w->name }}
        </option>
    @endforeach
</select>
    </div>
    <div class="form-group">
        @php
            $count=0;
        @endphp
        @foreach ($selected_exercises as $exercise)
            <div class="mt-10">
                <hr class="solid">
                <div class="mt-5 mb-5 h-50px">


                    <label for="">Select Exercise</label>
                    <select name="new_exercises[]" id="" class="form-control select">
                    @foreach ($all_exercises as $w)
                        @if ($exercise->exercise_library_id == $w->id)  selected  @endif
                        <option value="{{$w->id}}" >{{$w->name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="mt-5 mb-5 h-50px">
                    <label for=""><strong>Note:</strong></label><br>
                    <textarea name="notes_{{$count}}" id="" cols="30" rows="2" class="form-control">{{$set_details[$count][$week_start]->notes}}</textarea>

                </div>

                <div class="table-responsive ">
                    <table class="table-bordered program-table editable-program-table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Sets
                                </td>
                                <td colspan="2">Reps
                                </td>
                                <td>RPE</td>
                                <td>Load
                                </td>
                                <td>Rest
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($wr = $week_start; $wr <= $week_end; $wr++)
                                <tr>

                                    <td>{{ $wr }}
                                    </td>
                                    <td><input type="number" name="{{ $wr }}_set_no_{{$count}}" value="{{$set_details[$count][$wr]->set_no}}">
                                    </td>
                                    <td><input type="number" name="{{ $wr }}_rep_min_no_{{$count}}" value="{{$set_details[$count][$wr]->rep_min_no}}">
                                    </td>
                                    <td><input type="number" name="{{ $wr }}_rep_max_no_{{$count}}" value="{{$set_details[$count][$wr]->rep_max_no}}">
                                    </td>
                                    <td><input type="number" min="5" max="10" step="0.1" name="{{ $wr }}_rpe_no_{{$count}}" value="{{$set_details[$count][$wr]->rpe_no}}">
                                    </td>
                                    <td><input type="text" name="{{ $wr }}_load_text_{{$count}}" value="{{$set_details[$count][$wr]->load_text}}">
                                    </td>
                                    <td><input type="text" name="{{ $wr }}_rest_time_{{$count}}" value="{{$set_details[$count][$wr]->rest_time}}">
                                    </td>

                                </tr>
                            @endfor

                        </tbody>
                    </table>
                </div>
            </div>
            @php
                $count++;
            @endphp
        @endforeach
    </div>
</div>
</div>
</div>
    @endif


