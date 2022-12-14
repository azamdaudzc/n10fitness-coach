<?php

namespace App\Http\Controllers\N10Controllers;

use App\Models\User;
use App\Models\UserCheckin;
use App\Models\UserProgram;
use Illuminate\Http\Request;
use App\Models\WarmupBuilder;
use App\Models\ProgramBuilder;
use App\Models\ExerciseLibrary;
use App\Models\ExerciseCategory;
use App\Models\UserCheckinAnswer;
use App\Models\ProgramBuilderWeek;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramBuilderWeekDay;
use App\Models\ProgramBuilderDayWarmup;
use App\Models\ProgramBuilderDayExercise;
use App\Models\ProgramBuilderDayExerciseSet;
use App\Models\ProgramBuilderDayExerciseInput;

class ClientAnalyticsReportsController extends Controller
{
    function index(){
        $programs=UserProgram::where('assigned_by','=',Auth::user()->id)->with('user','program')->get();
        // return $programs;
        return view('N10Pages.Analyics.index',compact('programs'));
    }

    function analytics_summary_report($id = 0){
            $data['categories']=ExerciseCategory::all();
            $user_program=UserProgram::where('id',$id)->where('assigned_by',Auth::user()->id)->with('user','program')->get()->first();//this will be user wise
            $data['user_program']=$user_program;
            $id=$user_program->program_builder_id;
            $data['program'] = ProgramBuilder::find($id);
            $weeks = ProgramBuilderWeek::where('program_builder_id',$id)->get();
            $data['analytics_weeks']=array();
            $data['strength_stimulus']=array();
            $data['hypertrophic_stimulus']=array();
            $data['set_volume']=array();
            $data['intensity']=array();
            $data['sleep']=array();
            $data['motivation']=array();
            $data['stress']=array();
            $data['calories']=array();
            $data['calorie_compliance']=array();
            $data['proteins']=array();
            $data['protein_compliance']=array();
            $data['body_weight']=array();
            $data['waist']=array();
            $data['bodyfat']=array();

            foreach ($weeks as $week) {
                array_push($data['analytics_weeks'],$week->week_no);
                array_push($data['intensity'],$week->week_no);

                $checkin=UserCheckin::where('user_id',$user_program->user_id)
                ->whereBetween('created_at', [$week->start_date." 00:00:00", $week->end_date." 23:59:59"])->get()->first();
                if($checkin){
                $ans=UserCheckinAnswer::where('user_checkin_id',$checkin->id)->with('checkinQuestionInput')->get();

                foreach ($ans as  $value) {
                    # code...
                    $digit=str_replace("\"","",$value->answer);

                    if($value->checkinQuestionInput->analytics_hook=='calories')
                        array_push($data['calories'],$digit);

                    if($value->checkinQuestionInput->analytics_hook=='proteins')
                        array_push($data['proteins'],$digit);

                    if($value->checkinQuestionInput->analytics_hook=='sleep'){
                        array_push($data['sleep'],round(($digit/7)*100));
                    }

                    if($value->checkinQuestionInput->analytics_hook=='motivation'){
                        array_push($data['motivation'],round(($digit/10)*100));
                    }

                    if($value->checkinQuestionInput->analytics_hook=='stress'){
                        array_push($data['stress'],round(($digit/10)*100));
                    }

                    if($value->checkinQuestionInput->analytics_hook=='calories_compliance_between'){
                        array_push($data['calorie_compliance'],round(($digit/10)*100));
                    }

                    if($value->checkinQuestionInput->analytics_hook=='protein_compliance_between'){
                        array_push($data['protein_compliance'],round(($digit/10)*100));
                    }

                }


            }

            $week_day=ProgramBuilderWeekDay::where('program_builder_week_id', $week->id)->get();
            $hyper=0;
            $strength=0;
            $weight=0;
            $waist=0;
            foreach ($week_day as $day) {
                $week_day_exercises=ProgramBuilderDayExercise::where('builder_week_day_id',$day->id)->with('exerciseLibrary.exerciseCategory')->get();
                foreach ($week_day_exercises as  $week_day_exercise) {
                    $set=   ProgramBuilderDayExerciseSet::where('program_week_days',$week_day_exercise->id)->get()->first();
                    for ($i=1; $i <= $set->set_no; $i++) {
                        $set_answer=ProgramBuilderDayExerciseInput::where('day_exercise_id',$week_day_exercise->id)
                        ->where('program_builder_id',$id)
                        ->where('user_program',$user_program->id)
                        ->where('set_no',$i)->get()->first();
                       if($set_answer){

                        if($set_answer->reps > 5){
                            $hyper+=1;
                        }
                        else if($set_answer->reps > 0 && $set_answer->reps <= 5){
                            $strength+=1;
                        }
                    }
                    }
                }
                if($day->client_weight>0)
                    $weight=$day->client_weight;
                if($day->client_waist>0)
                    $waist=$day->client_waist;
            }

            array_push($data['body_weight'],$weight);
            array_push($data['waist'],$waist);
            $body_fat=0;
            $user=User::where('id',$user_program->user_id)->get()->first();
            if($weight>0 && $user->height>0 && $user->age>0){
                $BMI=round($weight/(($user->height/100)*($user->height/100)),2);
                $body_fat= (1.20 * $BMI) + (0.23 * $user->age) - 5.4;
                $body_fat=round($body_fat,2);
                $body_fat=22;
            }
            array_push($data['bodyfat'],$body_fat);
            array_push($data['strength_stimulus'],$strength);
            array_push($data['hypertrophic_stimulus'],$hyper);
            array_push($data['set_volume'],$strength+$hyper);

            if(count($data['analytics_weeks']) > count($data['calories']))
            array_push($data['calories'],0);
            if(count($data['analytics_weeks']) > count($data['proteins']))
            array_push($data['proteins'],0);
            if(count($data['analytics_weeks']) > count($data['protein_compliance']))
            array_push($data['protein_compliance'],0);
            if(count($data['analytics_weeks']) > count($data['sleep']))
            array_push($data['sleep'],0);
            if(count($data['analytics_weeks']) > count($data['motivation']))
            array_push($data['motivation'],0);
            if(count($data['analytics_weeks']) > count($data['stress']))
            array_push($data['stress'],0);
            if(count($data['analytics_weeks']) > count($data['calorie_compliance']))
            array_push($data['calorie_compliance'],0);



            }

            return view('N10Pages.Analyics.analytics-summary-report')->with($data);
        }

}
