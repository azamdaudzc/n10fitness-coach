<?php

namespace App\Http\Controllers\N10Controllers;

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
use App\Http\Resources\ProgramBuilderResource;
use App\Http\Resources\ProgramClientResource;

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
        return view('N10Pages.ProgramBuilder.file-build', compact('name', 'weeks', 'days', 'data', 'title', 'warmups', 'exercises'));
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
            $data['week_data'] = ProgramBuilderWeek::where('program_builder_id', $data['program']->id)->get();
            foreach ($data['week_data'] as  $week_data) {
                $data['per_week_data'][$week_data->week_no] = $week_data;
                $data['week_day_data'][$week_data->week_no] = ProgramBuilderWeekDay::where('program_builder_week_id', $week_data->id)->get();
                foreach ($data['week_day_data'][$week_data->week_no] as  $week_day_data) {
                    $data['week_day_warmup_data'][$week_data->week_no][$week_day_data->day_no] = ProgramBuilderDayWarmup::where('program_builder_week_day_id', $week_day_data->id)->get();
                    $data['week_day_exercise_data'][$week_data->week_no][$week_day_data->day_no]  = ProgramBuilderDayExercise::where('builder_week_day_id', $week_day_data->id)->get();
                    foreach ($data['week_day_exercise_data'][$week_data->week_no][$week_day_data->day_no] as  $week_day_exercise_data) {
                        $data['week_day_exercise_set'][$week_day_exercise_data->id] = ProgramBuilderDayExerciseSet::where('program_week_days', $week_day_exercise_data->id)->get()->first();
                    }
                }
            }
            return view('N10Pages.ProgramBuilder.edit-form')->with($data);
        }
        // dd($data['week_day_warmup_data']);
        return view('N10Pages.ProgramBuilder.form')->with($data);
    }




    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            $weeks = $request->no_of_weeks;
            $days = $request->no_of_days;
            $program_name = $request->program_name;
            $input = $request->all();

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
            } else {
                $program = ProgramBuilder::create([
                    'title' => $program_name,
                    'days' => $days,
                    'weeks' => $weeks,
                    'created_by' => Auth::user()->id,
                ]);
            }


            for ($week = 1; $week <= $weeks; $week++) {
                $new_week = ProgramBuilderWeek::create([
                    'program_builder_id' => $program->id,
                    'week_no' => $week,
                    'assigned_calories' => $input['week-' . $week . '-calories'],
                    'assigned_proteins' => $input['week-' . $week . '-proteins'],
                ]);
                for ($day = 1; $day <= $days; $day++) {
                    $new_day = ProgramBuilderWeekDay::create([
                        'program_builder_week_id' => $new_week->id,
                        'day_title' => 'Day ' . $day,
                        'day_no' => $day
                    ]);

                    ProgramBuilderDayWarmup::create([
                        'program_builder_week_day_id' => $new_day->id,
                        'warmup_builder_id' => $input['week-' . $week . '-day-' . $day . '-warmup']
                    ]);



                    foreach ($input['kt_program_repeater_w_' . $week . '_d_' . $day] as  $value) {

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
                            'notes' => '',
                        ]);
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
}
