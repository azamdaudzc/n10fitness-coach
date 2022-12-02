<?php

namespace App\Http\Controllers\N10Controllers;

use Illuminate\Http\Request;
use App\Models\WarmupBuilder;
use App\Models\ProgramBuilder;
use App\Models\ExerciseLibrary;
use App\Models\ProgramBuilderWeek;
use App\Models\ProgramBuilderShare;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramBuilderWeekDay;
use App\Models\ProgramBuilderDayWarmup;
use App\Models\ProgramBuilderDayExercise;
use App\Models\ProgramBuilderDayExerciseSet;
use App\Http\Resources\ProgramSharedResource;

class ProgramSharedController extends Controller
{
    //

    function sharedPrograms(Request $request){

        return view('N10Pages.ProgramBuilder.shared-programs');
    }

    function sharedProgramsList(Request $request){
        $programs = ProgramBuilderShare::where('user_id',Auth::user()->id)->with('programBuilder')->get();
        return new ProgramSharedResource($programs);

    }

    function sharedProgramsSave($id=0)  {
        $data['warmups'] = WarmupBuilder::where('approved_by', '>', 0)->get();
        $data['exercises'] = ExerciseLibrary::where('approved_by', '>', 0)->get();
        $data['page_heading'] = "Add Program";
        $data['sub_page_heading'] = collect(['User', 'ExerciseLibrary']);
        $data['data'] = new ProgramBuilder();
        $data['title'] = "Add Program";
        if ($id > 0) {
            $data['title'] = "Edit Program";
            $data['page_heading'] = "Edit Program";
            $data['sub_page_heading'] = collect(['User', 'ExerciseLibrary ']);
            $data['program'] = ProgramBuilder::find($id);
            $data['week_data'] = ProgramBuilderWeek::where('program_builder_id', $data['program']->id)->distinct('week_group')->get();
            $data['all_group_data'] = ProgramBuilderWeek::where('program_builder_id', $data['program']->id)->get();
            $data['week_group_count'] = ProgramBuilderWeek::where('program_builder_id', $data['program']->id)->distinct('week_group')->count();
            foreach ($data['week_data'] as $value) {
                $data['week_group_range'][$value->week_group] = ProgramBuilderWeek::where('program_builder_id', $data['program']->id)->where('week_group', $value->week_group)->selectRaw(" MIN(week_no) AS StartFrom, MAX(week_no) AS EndTo")->get()->first();
            }

            foreach ($data['week_data'] as  $week_data) {
                $data['per_group_data'][$week_data->week_group] = $week_data;
                $data['week_day_data'][$week_data->week_group] = ProgramBuilderWeekDay::where('program_builder_week_id', $week_data->id)->get();
                foreach ($data['week_day_data'][$week_data->week_group] as  $week_day_data) {
                    $data['week_day_warmup_data'][$week_data->week_group][$week_day_data->day_no] = ProgramBuilderDayWarmup::where('program_builder_week_day_id', $week_day_data->id)->get();
                    $data['day_title'][$week_data->week_group][$week_day_data->day_no] = $week_day_data->day_title;
                    $data['selected_warmup_ids'][$week_data->week_group][$week_day_data->day_no] = array();
                    foreach ($data['week_day_warmup_data'][$week_data->week_group][$week_day_data->day_no] as $selected) {
                        array_push($data['selected_warmup_ids'][$week_data->week_group][$week_day_data->day_no], $selected->warmup_builder_id);
                    }
                    $data['week_day_exercise_data'][$week_data->week_group][$week_day_data->day_no]  = ProgramBuilderDayExercise::where('builder_week_day_id', $week_day_data->id)->get();
                    foreach ($data['week_day_exercise_data'][$week_data->week_group][$week_day_data->day_no] as  $week_day_exercise_data) {
                        $data['week_day_exercise_set'][$week_day_exercise_data->id] = ProgramBuilderDayExerciseSet::where('program_week_days', $week_day_exercise_data->id)->get()->first();
                    }
                }
            }
            return view('N10Pages.ProgramBuilder.shared-programs-saveasyours')->with($data);

        }
        // dd($data['week_day_warmup_data']);
        return view('N10Pages.ProgramBuilder.shared-programs-saveasyours')->with($data);

    }

}
