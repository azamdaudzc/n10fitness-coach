<?php

namespace App\Http\Controllers\N10Controllers;

use Illuminate\Http\Request;
use App\Models\WarmupBuilder;
use App\Models\ProgramBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProgramBuilderResource;
use App\Models\ExerciseLibrary;

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
        $users = ProgramBuilder::where('created_by',Auth::user()->id)->orWhere('approved_by','>',0)->get();
        return new ProgramBuilderResource($users);
    }

    public function details(Request $request)
    {
        $page_heading = 'ExerciseLibrary';
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $data = new ProgramBuilder();
        $title="Add ExerciseLibrary";
        if($request->id){
            $title="Edit ExerciseLibrary";
            $data = ProgramBuilder::find($request->id);
        }
        // $videos = ProgramVideo::where('program_builder_id', $request->id)->get();

        return view('N10Pages.ProgramBuilder.view', compact('videos','data','title','page_heading','sub_page_heading'));
    }

    public function create_edit($id=0)
    {
        // $programvideos = ProgramVideo::where('program_builder_id', $id)->get();
        $warmups = WarmupBuilder::all();
        $exercises = ExerciseLibrary::all();
        $page_heading = "Add Program";
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $data = new ProgramBuilder();
        $title = "Add Program";
        if ($id > 0) {
            $title = "Edit Program";
            $page_heading = "Edit Program";
            $sub_page_heading = collect(['User', 'ExerciseLibrary']);
            $data = ProgramBuilder::find($id);
        }

        return view('N10Pages.ProgramBuilder.form', compact('exercises','warmups','data', 'title', 'page_heading', 'sub_page_heading'));
    }

    public function store(Request $request)
    {

        if (isset($request->id)) {
            $program = ProgramBuilder::find($request->id);
            if($program->created_by != Auth::user()->id){
                return response()->json(['success' => true, 'msg' => 'This is not created by you to edit']);
            }
            request()->validate(ProgramBuilder::$rules);
            $program->update($request->all());

            // ProgramVideo::where('program_builder_id', $request->id)->delete();
            foreach ($request->kt_docs_repeater_basic as $item) {
                if ($item['video_url'] !== null) {
                    if (array_key_exists('thumbnail', $item)) {
                        $thumbnail = $this->saveThumbnailImage($request, $item['thumbnail']);
                    } else {
                        if (array_key_exists('old_thumbnail', $item)) {
                            $thumbnail = $item['old_thumbnail'];
                        } else {
                            $thumbnail = null;
                        }
                    }
                    $video_url = $item['video_url'];
                    $lid = $request->id;
                    // ProgramVideo::create([
                    //     'program_builder_id' => $lid,
                    //     'thumbnail' => $thumbnail,
                    //     'video_url' => $video_url,
                    // ]);
                }
            }

            return response()->json(['success' => true, 'msg' => 'Program Updated']);
        } else {
            request()->validate(ProgramBuilder::$rules);
            $program = ProgramBuilder::create(array_merge($request->all(), ['created_by' => Auth::user()->id]));

            foreach ($request->kt_docs_repeater_basic as $item) {


                if ($item['video_url'] !== null) {
                    if (array_key_exists('thumbnail', $item)) {
                        $thumbnail = $this->saveThumbnailImage($request, $item['thumbnail']);
                    } else {
                        if (array_key_exists('old_thumbnail', $item)) {
                            $thumbnail = $item['old_thumbnail'];
                        } else {
                            $thumbnail = null;
                        }
                    }
                    $video_url = $item['video_url'];
                    $lid = $program->id;
                    // ProgramVideo::create([
                    //     'program_builder_id' => $lid,
                    //     'thumbnail' => $thumbnail,
                    //     'video_url' => $video_url,
                    // ]);
                }
            }

            return response()->json(['success' => true, 'msg' => 'Program Created']);
        }
    }


    public function delete(Request $request)
    {
        $program = ProgramBuilder::find($request->id);
            if($program->created_by != Auth::user()->id){
                return response()->json(['success' => true, 'msg' => 'This is not created by you to delete']);
            }
        // ProgramVideo::where('program_builder_id', $request->id)->delete();
        $athletictype = ProgramBuilder::find($request->id)->delete();
        return response()->json(['success' => true, 'msg' => 'Question Deleted']);
    }
}
