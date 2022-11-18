<?php

namespace App\Http\Controllers\N10Controllers;

use Exception;
use App\Models\User;
use App\Models\ClientCoach;
use App\Models\UserProgram;
use Illuminate\Http\Request;
use App\Models\WarmupBuilder;
use App\Models\ProgramBuilder;
use App\Models\ExerciseLibrary;
use App\Models\ProgramBuilderWeek;
use Illuminate\Support\Facades\DB;
use App\Models\ProgramBuilderShare;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramBuilderWeekDay;
use App\Models\ProgramBuilderDayWarmup;
use App\Models\ProgramBuilderDayExercise;
use App\Models\ProgramBuilderDayExerciseSet;
use App\Http\Resources\ProgramClientResource;
use App\Http\Resources\ProgramBuilderResource;

class ProgramBuilderController extends Controller
{
    public function index()
    {
        $page_heading = 'Program Builder';
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $data = new ProgramBuilder();
        return view('N10Pages.ProgramBuilder.index', compact('page_heading', 'sub_page_heading', 'data'));
    }

    public function list()
    {
        $users = ProgramBuilder::where('created_by', Auth::user()->id)->orWhere('approved_by', '>', 0)->get();
        return new ProgramBuilderResource($users);
    }

    public function details(Request $request)
    {
        $data = new ProgramBuilder();
        $title = "Add Admin";
        $warmups = WarmupBuilder::where('approved_by', '>', 0)->get();
        $exercises = ExerciseLibrary::where('approved_by', '>', 0)->get();
        $name = $request->name;
        $days = $request->days;
        $weeks = $request->weeks;
        if (isset($request->counter)) {
            $counter = $request->counter;
            $add_group = 0;
        } else {
            $counter = 1;
            $add_group = 1;
        }
        return view('N10Pages.ProgramBuilder.file-build', compact('add_group', 'counter', 'name', 'weeks', 'days', 'data', 'title', 'warmups', 'exercises'));
    }



    public function assign_clients($id = 0)
    {
        $data['program_id'] = $id;
        $data['all_users']
            = ClientCoach::with('user.userAthleticType')->where('coach_id', Auth::user()->id)->get();
        return view('N10Pages.ProgramBuilder.assign-clients')->with($data);
    }

    public function attach_client(Request $request)
    {
        if (UserProgram::where('program_builder_id', $request->program_id)->where('user_id', $request->client_id)->exists()) {
            return response()->json(['success' => false, 'msg' => 'Client Already Attached']);
        }
        UserProgram::create([
            'program_builder_id' => $request->program_id,
            'user_id' => $request->client_id,
        ]);
        return response()->json(['success' => true, 'msg' => 'Client Attached']);
    }

    public function deleteclient(Request $request)
    {
        $user = UserProgram::find($request->id)->delete();
        return response()->json(['success' => true, 'msg' => 'Client Deleted']);
    }

    public function assigedclients($id = 0)
    {

        $users = UserProgram::where('program_builder_id', $id)->with('user')->get();
        return new ProgramClientResource($users);
    }

    public function create_edit($id = 0)
    {
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
            return view('N10Pages.ProgramBuilder.edit-form')->with($data);
        }
        // dd($data['week_day_warmup_data']);
        return view('N10Pages.ProgramBuilder.form')->with($data);
    }

    public function view($id = 0)
    {
        $data['warmups'] = WarmupBuilder::where('approved_by', '>', 0)->get();
        $data['exercises'] = ExerciseLibrary::where('approved_by', '>', 0)->get();

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
            return view('N10Pages.ProgramBuilder.view')->with($data);
        }

    }



    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            $weeks = $request->no_of_weeks;
            $group_counter = $request->group_counter;
            $days = $request->no_of_days;
            $program_name = $request->program_name;
            $input = $request->all();

            // ------------ week validation area -----------
            $past_from_week=0;
            $past_to_week=0;
            $error=false;

            if($input['group-' . 1 . '-from']!=1){
                $error=true;
            }
            if($input['group-' . $group_counter-1 . '-to']!=$weeks){
                $error=true;
            }

            for ($jo = 1; $jo < $group_counter; $jo++) {
                $from_week = $input['group-' . $jo . '-from'];
                $to_week = $input['group-' . $jo . '-to'];
                if($past_from_week!=0 && $past_to_week!=0 ){
                    if($past_to_week+1 != $from_week){
                        $error=true;
                        break;
                    }
                }
                $past_from_week=$from_week;
                $past_to_week=$to_week;
            }
            if($error){
                return response()->json(['success' => false, 'msg' => 'Week Arrangement Not Correct']);
            }
            // ------------ week validation area -----------

            if (isset($request->program_id)) {
                $program = ProgramBuilder::find($request->program_id);
                $program->update([
                    'title' => $program_name,
                    'days' => $days,
                    'weeks' => $weeks,

                ]);
                try {
                    ProgramBuilderWeek::where('program_builder_id', $request->program_id)->delete();
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['success' => false, 'msg' => 'Error Occured']);
                }
                $group_counter = $group_counter + 1;
            } else {
                $program = ProgramBuilder::create([
                    'title' => $program_name,
                    'days' => $days,
                    'weeks' => $weeks,
                    'created_by' => Auth::user()->id,
                ]);
            }

            for ($counter = 1; $counter < $group_counter; $counter++) {

                $from_week = $input['group-' . $counter . '-from'];
                $to_week = $input['group-' . $counter . '-to'];


                for ($week_no = $from_week; $week_no <= $to_week; $week_no++) {

                    $new_week = ProgramBuilderWeek::create([
                        'program_builder_id' => $program->id,
                        'week_group' => $counter,
                        'week_no' => $week_no,
                        'assigned_calories' => $input['week-' . $week_no . '-calories'],
                        'assigned_proteins' => $input['week-' . $week_no . '-proteins'],
                    ]);

                    for ($day = 1; $day <= $days; $day++) {
                        $new_day = ProgramBuilderWeekDay::create([
                            'program_builder_week_id' => $new_week->id,
                            'day_title' => 'Day ' . $day,
                            'day_no' => $day
                        ]);
                        foreach ($input['group-' . $counter . '-day-' . $day . '-warmup'] as $warmup) {
                            ProgramBuilderDayWarmup::create([
                                'program_builder_week_day_id' => $new_day->id,
                                'warmup_builder_id' => $warmup
                            ]);
                        }



                        foreach ($input['kt_program_repeater_w_' . $counter . '_d_' . $day] as  $value) {

                            $new_day_exercise = ProgramBuilderDayExercise::create([
                                'builder_week_day_id' => $new_day->id,
                                'exercise_library_id' => $value['day_exercise'],
                                'sets_no' => 0,
                            ]);

                            ProgramBuilderDayExerciseSet::create([
                                'program_week_days' => $new_day_exercise->id,
                                'set_no' => $value['exercise-sets-no'],
                                'rep_min_no' => $value['exercise-rep-min'],
                                'rep_max_no' => $value['exercise-rep-max'],
                                'rpe_no' => $value['exercise-rpe'],
                                'load_text' => $value['exercise-load'],
                                'rest_time' => $value['exercise-rest-time'],
                                'notes' => $value['exercise-notes'],
                            ]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e]);
        }
        DB::commit();
        return response()->json(['success' => true, 'msg' => 'Program Created']);
    }

    public function shareProgram(Request $request)
    {
        ProgramBuilderShare::create([
            'program_builder_id' => $request->program_builder_id,
            'user_id' => $request->user_id,
        ]);
        return response()->json(['success' => true, 'msg' => 'Program Shared']);
    }

    public function delete(Request $request)
    {
        $program = ProgramBuilder::find($request->id);
        if ($program->created_by != Auth::user()->id) {
            return response()->json(['success' => true, 'msg' => 'This is not created by you to delete']);
        }
        ProgramBuilder::find($request->id)->delete();
        return response()->json(['success' => true, 'msg' => 'Program Deleted']);
    }

    public function semiUpdate(Request $request){
        if($request->update_type=='name'){
            ProgramBuilder::find($request->program_id)->update(['title' => $request->name]);
            return response()->json(['success' => true, 'msg' => 'Program Updated']);

        }
    }

    public function getSemiUpdateData(Request $request){
        if($request->type=='calories_proteins'){
            $data['week_start']=$request->week_start;
            $data['week_end']=$request->week_end;
            return view('N10Pages.ProgramBuilder.semi-edit-calories-protiens')->with($data);
        }
    }
}
