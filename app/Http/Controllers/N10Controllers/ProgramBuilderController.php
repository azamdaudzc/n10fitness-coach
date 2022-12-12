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
use App\Http\Resources\ProgramSharedResource;
use App\Http\Resources\ProgramBuilderResource;
use App\Models\UserPermission;

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
        $one = ProgramBuilder::where('created_by', Auth::user()->id)->get();
        $two=ProgramBuilderShare::where('user_id',Auth::user()->id)->join('program_builders','program_builder_shares.program_builder_id','=','program_builders.id')->select('program_builders.*')->get();
        $users = $one->merge($two);
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

        if (UserProgram::where('program_builder_id', $request->program_id)->where('assigned_by',Auth::user()->id)->where('user_id', $request->client_id)->exists()) {
            return response()->json(['success' => false, 'msg' => 'Client Already Attached']);
        }
        UserProgram::create([
            'program_builder_id' => $request->program_id,
            'user_id' => $request->client_id,
            'assigned_by' => Auth::user()->id,
        ]);

        $name="Program Assigned";
        $message="Program ".ProgramBuilder::find($request->program_id)->title." Was Assigned";
        $url="";
        $type="ProgramAssigned";
        $this->sendNotification($request->client_id,$name,$message,$url,$type);

        return response()->json(['success' => true, 'msg' => 'Client Attached']);
    }

    public function deleteclient(Request $request)
    {
        $user = UserProgram::find($request->id);
        $name="Program Removed";
        $message="Program ".ProgramBuilder::find($user->program_builder_id)->title." Was Removed";
        $url="";
        $type="ProgramRemoved";
        $this->sendNotification($user->user_id,$name,$message,$url,$type);
        $user->delete();
        return response()->json(['success' => true, 'msg' => 'Client Deleted']);
    }

    public function assigedclients($id = 0)
    {

        $users = UserProgram::where('program_builder_id', $id)->where('assigned_by',Auth::user()->id)->with('user')->get();
        return new ProgramClientResource($users);
    }

    public function create_edit($id = 0)
    {
        if(!$this->canDeployPrograms()){
            return response()->json(['success' => false, 'msg' => 'You Are Not Permitted To Work On Programs']);

        }
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
            return view('N10Pages.ProgramBuilder.edit-form')->with($data);
        }
        // dd($data['week_day_warmup_data']);
        return view('N10Pages.ProgramBuilder.form')->with($data);
    }

    public function view($id = 0)
    {
        if(!$this->canDeployPrograms()){
            return response()->json(['success' => false, 'msg' => 'You Are Not Permitted To Work On Programs']);

        }
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
                    $data['day_title'][$week_data->week_group][$week_day_data->day_no] = $week_day_data->day_title;
                    foreach ($data['week_day_warmup_data'][$week_data->week_group][$week_day_data->day_no] as $selected) {
                        array_push($data['selected_warmup_ids'][$week_data->week_group][$week_day_data->day_no], $selected->warmup_builder_id);
                    }
                    $data['week_day_exercise_data'][$week_data->week_group][$week_day_data->day_no]  = ProgramBuilderDayExercise::where('builder_week_day_id', $week_day_data->id)->get();
                    $count=0;
                    foreach ($data['week_day_exercise_data'][$week_data->week_group][$week_day_data->day_no] as  $week_day_exercise_data) {
                        $data['week_day_exercise_set'][$week_data->week_group][$week_day_data->day_no][$count][$week_data->week_no] = ProgramBuilderDayExerciseSet::where('program_week_days', $week_day_exercise_data->id)->get()->first();
                        $count++;
                    }
                }
            }

            return view('N10Pages.ProgramBuilder.view')->with($data);
        }

    }



    public function store(Request $request)
    {
        if(!$this->canDeployPrograms()){
            return response()->json(['success' => false, 'msg' => 'You Are Not Permitted To Work On Programs']);

        }
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
            if (isset($request->program_id)) {
                if($input['group-' . $group_counter . '-to']!=$weeks){
                    $error=true;
                }
            }
            else{
            if($input['group-' . $group_counter-1 . '-to']!=$weeks){
                $error=true;
            }
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
                            'day_title' => $input['group-' . $counter . '-day-' . $day . '-dayname'],
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

            $name="Program Created";
            $message="Coach ".Auth::user()->first_name.' '.Auth::user()->last_name." Created Program";
            $url="";
            $type="ProgramCreated";
            $admin=User::where('user_type','admin')->get()->first()->id;
            $this->sendNotification($admin,$name,$message,$url,$type);

        } catch (\Exception $e) {
            DB::rollback();
            if (strpos($e->getMessage(), 'Numeric value out of range') !== false) {
                return response()->json(['success' => false, 'msg' => 'Numeric value out of range']);

            }
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
        DB::commit();
        return response()->json(['success' => true, 'msg' => 'Program Created']);
    }



    public function delete(Request $request)
    {
        if(!$this->canDeployPrograms()){
            return response()->json(['success' => false, 'msg' => 'You Are Not Permitted To Work On Programs']);

        }
        $program = ProgramBuilder::find($request->id);
        if ($program->created_by != Auth::user()->id) {
            return response()->json(['success' => true, 'msg' => 'This is not created by you to delete']);
        }
        ProgramBuilder::find($request->id)->delete();
        return response()->json(['success' => true, 'msg' => 'Program Deleted']);
    }

    public function semiUpdate(Request $request){
        if(!$this->canDeployPrograms()){
            return response()->json(['success' => false, 'msg' => 'You Are Not Permitted To Work On Programs']);

        }
        $input=$request->all();
        if($request->update_type=='program_name'){
            ProgramBuilder::find($request->program_id)->update(['title' => $request->new_program_name]);
            return response()->json(['success' => true, 'msg' => 'Program Updated']);

        }
        else if($request->update_type=='program_day_edit'){

            $input=$request->all();
            $data['group']=$request->group;


            $data['program']=ProgramBuilder::find($request->program_id)->get();
            $data['weeks']=ProgramBuilderWeek::where('program_builder_id','=',$request->program_id)->where('week_group',$request->group)->get();
            foreach ($data['weeks'] as $w) {
                $data['week_days'][$w->week_no]=ProgramBuilderWeekDay::where('day_no',$request->selected_day)->where('program_builder_week_id',$w->id)->get()->first();
                ProgramBuilderWeekDay::where('day_no',$request->selected_day)->where('program_builder_week_id',$w->id)->update(['day_title' => $request->new_dayname]);
                $week_day=$data['week_days'][$w->week_no];
                    // $data['selected_exercises']=ProgramBuilderDayExercise::where('builder_week_day_id',$week_day->id)->get();

                    ProgramBuilderDayWarmup::where('program_builder_week_day_id',$week_day->id)->delete();
                    foreach ($request->new_warmups as $warmup) {
                        ProgramBuilderDayWarmup::create([
                            'program_builder_week_day_id' => $week_day->id,
                            'warmup_builder_id' => $warmup,
                        ]);
                    }

                    ProgramBuilderDayExercise::where('builder_week_day_id',$week_day->id)->delete();
                    $count=0;
                    foreach ($request->new_exercises as $exercise) {
                        $new=ProgramBuilderDayExercise::create([
                            'builder_week_day_id' => $week_day->id,
                            'exercise_library_id' => $exercise,
                        ]);

                        ProgramBuilderDayExerciseSet::create([
                            'program_week_days' => $new->id,
                            'set_no' => $input[$w->week_no.'_set_no_'.$count],
                            'rep_min_no' => $input[$w->week_no.'_rep_min_no_'.$count],
                            'rep_max_no' => $input[$w->week_no.'_rep_max_no_'.$count],
                            'rpe_no' => $input[$w->week_no.'_rpe_no_'.$count],
                            'load_text' => $input[$w->week_no.'_load_text_'.$count],
                            'rest_time' => $input[$w->week_no.'_rest_time_'.$count],
                            'notes' => $input['notes_'.$count],
                        ]);
                        $count++;
                    }

            }

            return response()->json(['success' => true, 'msg' => 'Program Updated']);

        }
        else if($request->update_type=='calories_proteins'){
            for ($i=$request->week_start; $i <= $request->week_end ; $i++) {
                ProgramBuilderWeek::where('program_builder_id',$request->program_id)->where('week_no',$i)
                ->update(['assigned_calories' => $input['week-'.$i.'-calories'] , 'assigned_proteins' => $input['week-'.$i.'-proteins'] ]);
            }
            return response()->json(['success' => true, 'msg' => 'Program Updated']);
        }
        return response()->json(['success' => false, 'msg' => 'No Program Type Found']);

    }

    public function getSemiUpdateData(Request $request){
        if($request->type=='calories_proteins'){
            $data['week_start']=$request->week_start;
            $data['week_end']=$request->week_end;
            $data['type']='calories_proteins';
            $data['program_id']=$request->program_id;
        }
        else if($request->type=='program_day_edit'){
            $data['week_start']=$request->week_start;
            $data['week_end']=$request->week_end;
            $data['group']=$request->group;
            $data['day']=$request->day;
            $data['type']='program_day_edit';
            $data['all_warmups'] = WarmupBuilder::where('approved_by', '>', 0)->get();
            $data['all_exercises'] = ExerciseLibrary::where('approved_by', '>', 0)->get();
            $data['program_id']=$request->program_id;

            $data['program']=ProgramBuilder::find($request->program_id)->get();
            $data['weeks']=ProgramBuilderWeek::where('program_builder_id','=',$request->program_id)->where('week_group',$request->group)->get();
            foreach ($data['weeks'] as $w) {
                $data['week_days'][$w->week_no]=ProgramBuilderWeekDay::where('day_no',$request->day)->where('program_builder_week_id',$w->id)->get()->first();
                $week_day=$data['week_days'][$w->week_no];
                    $data['selected_exercises']=ProgramBuilderDayExercise::where('builder_week_day_id',$week_day->id)->get();
                    $data['selected_warmups']=ProgramBuilderDayWarmup::where('program_builder_week_day_id',$week_day->id)->pluck('warmup_builder_id')->toArray();
                    $data['day_title']=$week_day->day_title;
                $count=0;
                foreach ($data['selected_exercises'] as  $value) {
                    $data['set_details'][$count][$w->week_no]=ProgramBuilderDayExerciseSet::where('program_week_days',$value->id)->get()->first();
                    $count++;
                }
                }


        }
        else if($request->type=='program_name'){
            $data['type']='program_name';
            $data['program_id']=$request->program_id;
        }

        return view('N10Pages.ProgramBuilder.semi-edit-programs')->with($data);

    }



}
