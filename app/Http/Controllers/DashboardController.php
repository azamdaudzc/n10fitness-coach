<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    function index() {
        $data['page_heading'] = "Dashboard";
        $data['sub_page_heading'] = "main dashboard";
        $data['users']=DB::table('user_programs')
                        ->join('users','user_programs.user_id','=','users.id')
                        ->join('program_builders','user_programs.program_builder_id','=','program_builders.id')
                        ->join('program_builder_weeks','program_builders.id','=','program_builder_weeks.program_builder_id')
                        ->join('program_builder_week_days','program_builder_weeks.id','=','program_builder_week_days.program_builder_week_id')
                        ->join('program_builder_day_exercises','program_builder_week_days.id','=','program_builder_day_exercises.builder_week_day_id')
                        ->join('program_builder_day_exercise_sets','program_builder_day_exercises.id','=','program_builder_day_exercise_sets.program_week_days')
                        ->join('program_builder_day_exercise_inputs','program_builder_day_exercise_sets.id','=','program_builder_day_exercise_inputs.day_exercise_id')
                        ->select('users.avatar','users.first_name','users.last_name','users.email','user_programs.id',DB::RAW('count(program_builder_day_exercise_inputs.id) as sets_completed'),DB::RAW('sum(program_builder_day_exercise_inputs.reps) as total_reps'))
                        ->where('program_builder_day_exercise_inputs.reps','>',0)
                        ->groupBy('id','avatar','first_name','last_name','email')->get();

        return view('dashboard')->with($data);
    }
}
