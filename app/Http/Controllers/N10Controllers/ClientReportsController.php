<?php

namespace App\Http\Controllers\N10Controllers;

use App\Models\UserProgram;
use Illuminate\Http\Request;
use App\Models\WarmupBuilder;
use App\Models\ProgramBuilder;
use App\Models\ExerciseLibrary;
use App\Models\ProgramBuilderWeek;
use App\Http\Controllers\Controller;
use App\Models\ExerciseCategory;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramBuilderWeekDay;
use App\Models\ProgramBuilderDayWarmup;
use App\Models\ProgramBuilderDayExercise;
use App\Models\ProgramBuilderDayExerciseInput;
use App\Models\ProgramBuilderDayExerciseSet;

class ClientReportsController extends Controller
{
    function index(){
        $programs=UserProgram::where('assigned_by','=',Auth::user()->id)->with('user')->get();
        // return $programs;
        return view('N10Pages.Reports.index',compact('programs'));
    }

    function exercise_summary_report($id = 0){
            $data['categories']=ExerciseCategory::all();
            $user_program=UserProgram::where('id',$id)->where('assigned_by',Auth::user()->id)->with('user','program')->get()->first();//this will be user wise
            $data['user_program']=$user_program;
            $id=$user_program->program_builder_id;
            $data['program'] = ProgramBuilder::find($id);
            $weeks = ProgramBuilderWeek::where('program_builder_id',$id)->get();
            foreach ($weeks as $week) {
                $week_day=ProgramBuilderWeekDay::where('program_builder_week_id', $week->id)->get();
                foreach ($week_day as $day) {
                    // $data['temp'][$day->day_no][$week->week_no]
                    $week_day_exercises=ProgramBuilderDayExercise::where('builder_week_day_id',$day->id)->with('exerciseLibrary.exerciseCategory')->get();
                    $data['exercises_report'][$week->week_no][$day->day_no]= $week_day_exercises;
                    foreach ($week_day_exercises as  $week_day_exercise) {
                        # code...
                        $set=   ProgramBuilderDayExerciseSet::where('program_week_days',$week_day_exercise->id)->get()->first();
                         $data['set'][$week->week_no][$day->day_no][$week_day_exercise->id]= $set->set_no;
                        for ($i=1; $i <= $set->set_no; $i++) {
                            # code...
                                // $data['temp'][$day->day_no][$week->week_no][$i]
                            $set_answer=ProgramBuilderDayExerciseInput::where('day_exercise_id',$week_day_exercise->id)
                            ->where('program_builder_id',$id)
                            ->where('user_program',$user_program->id)
                            ->where('set_no',$i)->get()->first();
                            $data['set_ans'][$week->week_no][$day->day_no][$week_day_exercise->id][$i] = $set_answer;
                        }
                    }
                }
            }
            return view('N10Pages.Reports.exercise-summary-report')->with($data);
        }

}
