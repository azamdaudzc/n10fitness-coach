<?php

namespace App\Http\Controllers\N10Controllers;

use Illuminate\Http\Request;
use App\Models\ExerciseMuscle;
use App\Models\ExerciseLibrary;
use App\Models\ExerciseCategory;
use App\Models\ExerciseEquipment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ExerciseLibraryMuscle;
use App\Models\ExerciseMovementPattern;
use App\Http\Resources\ExerciseLibraryResource;

class ExerciseLibraryController extends Controller
{
    public function index(Request $request)
    {
        $page_heading = 'ExerciseLibrary';
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $library = new ExerciseLibrary();
        return view('N10Pages.ExerciseLibrary.index', compact('page_heading', 'sub_page_heading', 'library'));
    }

    public function list(Request $request)
    {
        $librarys = null;
        $librarys = ExerciseLibrary::with('exerciseCategory','exerciseCreator')->where('created_by',Auth::user()->id)->orWhere('approved_by','>',0)->get();

        return new ExerciseLibraryResource($librarys);
    }

    public function details(Request $request)
    {
        $page_heading = 'ExerciseLibrary';
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $data = new ExerciseLibrary();
        $title="Add ExerciseLibrary";
        if($request->id){
            $title="Edit ExerciseLibrary";
            $data = ExerciseLibrary::where('id',$request->id)->with('exerciseCategory','exerciseEquipment','exerciseMovementPattern')->get()->first();
        }
        $library_muscles = ExerciseLibraryMuscle::where('exercise_library_id', $request->id)->with('exerciseMuscle')->get();

        return view('N10Pages.ExerciseLibrary.view', compact('library_muscles','data','title','page_heading','sub_page_heading'));
    }

    public function create_edit($id = 0)
    {

        $page_heading = 'Exercise Library';
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $library = new ExerciseLibrary();
        $title = "Add ExerciseLibrary";
        if ($id > 0) {
            $title = "Edit Exercise Library";
            $sub_page_heading = collect(['User', 'ExerciseLibrary']);
            $library = ExerciseLibrary::find($id);
        }
        $library_muscles = ExerciseLibraryMuscle::where('exercise_library_id', $id)->get();
        $categories = ExerciseCategory::all();
        $equipments = ExerciseEquipment::all();
        $muscles = ExerciseMuscle::all();
        $movement_patterns = ExerciseMovementPattern::all();
        return view('N10Pages.ExerciseLibrary.form', compact('library', 'title', 'categories', 'equipments', 'movement_patterns', 'muscles', 'page_heading', 'sub_page_heading', 'library_muscles'));
    }

    public function info(Request $request)
    {
        $library = new ExerciseLibrary();
        if ($request->id) {
            $title = "Edit Exercise Library";
            $library = ExerciseLibrary::find($request->id);
        }
        return view('N10Pages.ExerciseLibrary.info', compact('library'));
    }

    public function view($id)
    {
        $library = new ExerciseLibrary();
        $page_heading = 'Exercise Librarys';
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        if ($id) {
            $library = ExerciseLibrary::find($id);
        }
        return view('N10Pages.ExerciseLibrary.view', compact('library', 'page_heading', 'sub_page_heading'));
    }

    public function store(Request $request)
    {
        // return $request;
        if (isset($request->id)) {
            request()->validate(ExerciseLibrary::rules($request->id));
            $library = ExerciseLibrary::find($request->id);
            if($library->created_by != Auth::user()->id){
                return response()->json(['success' => true, 'msg' => 'This is not created by you to edit']);
            }
            if ($request->hasFile('avatar')) {
                $newavatar = $this->updateprofile($request, 'avatar');
                unset($request['avatar']);
                $library->update(array_merge($request->all(), ['avatar' => $newavatar]));
            } else if ($request->avatar_remove == 1) {
                $library->update(array_merge($request->all(), ['avatar' => null]));
            } else {
                $library->update(array_merge($request->all()));
            }
            ExerciseLibraryMuscle::where('exercise_library_id', $request->id)->delete();
            foreach ($request->kt_docs_repeater_basic as $item) {
                $musclename = $item['musclename'];
                $muscleid = $item['muscleid'];
                $lid = $request->id;
                if ($musclename != null && $muscleid != null) {
                    ExerciseLibraryMuscle::create([
                        'exercise_library_id' => $lid,
                        'name' => $musclename,
                        'excercise_muscle_id' => $muscleid
                    ]);
                }
            }
            if($library->approved_by>0){
                $type='approved';
            }
            else if($library->rejected_by>0){
                $type='rejected';
            }
            else{
                $type='none';
            }
            return response()->json(['success' => true, 'msg' => 'ExerciseLibrary Edit Complete','type' => $type]);
        } else {
            request()->validate(ExerciseLibrary::rules());
            $newavatar = $this->updateprofile($request, 'avatar');
            unset($request['avatar']);
            if ($request->avatar_remove == 1) {
                $newavatar=null;
            }
            $library = ExerciseLibrary::create(array_merge($request->all(), ['avatar' => $newavatar, 'created_by' => Auth::user()->id, 'user_type' => 'admin']));

            foreach ($request->kt_docs_repeater_basic as $item) {
                $musclename = $item['musclename'];
                $muscleid = $item['muscleid'];
                $lid = $library->id;
                if ($musclename != null && $muscleid != null) {
                    ExerciseLibraryMuscle::create([
                        'exercise_library_id' => $lid,
                        'name' => $musclename,
                        'excercise_muscle_id' => $muscleid
                    ]);
                }
            }

            $type='requested';

            return response()->json(['success' => true, 'msg' => 'ExerciseLibrary Created','type' => $type]);
        }
        return response()->json(['success' => false, 'msg' => 'Some Error']);
    }


    public function delete(Request $request)
    {
        $library = ExerciseLibrary::find($request->id);
        if($library->created_by != Auth::user()->id){
            return response()->json(['success' => true, 'msg' => 'This is not created by you to delete']);
        }
        $library = ExerciseLibrary::find($request->id)->delete();
        return response()->json(['success' => true, 'msg' => 'Exercise Library Deleted']);
    }


}
