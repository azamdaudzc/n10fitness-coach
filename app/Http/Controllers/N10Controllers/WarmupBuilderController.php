<?php

namespace App\Http\Controllers\N10Controllers;

use App\Models\WarmupVideo;
use Illuminate\Http\Request;
use App\Models\WarmupBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\WarmupBuilderResource;

class WarmupBuilderController extends Controller
{
    public function index()
    {
        $page_heading = 'Warmup Builder';
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $data = new WarmupBuilder();
        return view('N10Pages.WarmupBuilder.index', compact('page_heading', 'sub_page_heading', 'data'));
    }

    public function list()
    {
        $users = WarmupBuilder::with('user')->where('created_by',Auth::user()->id)->orWhere('approved_by','>',0)->get();
        return new WarmupBuilderResource($users);
    }

    public function details(Request $request)
    {
        $page_heading = 'ExerciseLibrary';
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $data = new WarmupBuilder();
        $title="Add ExerciseLibrary";
        if($request->id){
            $title="Edit ExerciseLibrary";
            $data = WarmupBuilder::find($request->id);
        }
        $videos = WarmupVideo::where('warmup_builder_id', $request->id)->get();

        return view('N10Pages.WarmupBuilder.view', compact('videos','data','title','page_heading','sub_page_heading'));
    }

    public function create_edit($id=0)
    {
        $warmupvideos = WarmupVideo::where('warmup_builder_id', $id)->get();
        $page_heading = "Add Warmup";
        $sub_page_heading = collect(['User', 'ExerciseLibrary']);
        $data = new WarmupBuilder();
        $title = "Add Warmup";
        if ($id > 0) {
            $title = "Edit Warmup";
            $page_heading = "Edit Warmup";
            $sub_page_heading = collect(['User', 'ExerciseLibrary']);
            $data = WarmupBuilder::find($id);
        }

        return view('N10Pages.WarmupBuilder.form', compact('data', 'title', 'page_heading', 'sub_page_heading', 'warmupvideos'));
    }

    public function store(Request $request)
    {

        if (isset($request->id)) {
            $warmup = WarmupBuilder::find($request->id);
            if($warmup->created_by != Auth::user()->id){
                return response()->json(['success' => true, 'msg' => 'This is not created by you to edit']);
            }
            request()->validate(WarmupBuilder::$rules);
            $warmup->update($request->all());

            WarmupVideo::where('warmup_builder_id', $request->id)->delete();
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
                    WarmupVideo::create([
                        'warmup_builder_id' => $lid,
                        'thumbnail' => $thumbnail,
                        'video_url' => $video_url,
                    ]);
                }
            }

            return response()->json(['success' => true, 'msg' => 'Warmup Updated']);
        } else {
            request()->validate(WarmupBuilder::$rules);
            $warmup = WarmupBuilder::create(array_merge($request->all(), ['created_by' => Auth::user()->id]));

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
                    $lid = $warmup->id;
                    WarmupVideo::create([
                        'warmup_builder_id' => $lid,
                        'thumbnail' => $thumbnail,
                        'video_url' => $video_url,
                    ]);
                }
            }

            return response()->json(['success' => true, 'msg' => 'Warmup Created']);
        }
    }


    public function delete(Request $request)
    {
        $warmup = WarmupBuilder::find($request->id);
        if($warmup->created_by != Auth::user()->id){
            return response()->json(['success' => true, 'msg' => 'This is not created by you to delete']);
        }
        WarmupVideo::where('warmup_builder_id', $request->id)->delete();
        $athletictype = WarmupBuilder::find($request->id)->delete();
        return response()->json(['success' => true, 'msg' => 'Question Deleted']);
    }
}
