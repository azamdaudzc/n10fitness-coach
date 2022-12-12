<?php

namespace App\Http\Controllers\N10Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProgramBuilder;
use App\Models\ProgramBuilderShare;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProgramShareResource;

class ProgramShareController extends Controller
{

    public function shareProgram($id = 0)
    {
        $data['program_id'] = $id;
        $data['all_users']
        = User::where('user_type', 'coach')->get();
        $data['all_programs']=ProgramBuilder::where('created_by',Auth::user()->id)->where('approved_by','<>',0)->get();
        return view('N10Pages.ProgramBuilder.share-program')->with($data);
    }

    public function share_program_with_coach(Request $request)
    {
        if (ProgramBuilderShare::where('program_builder_id', $request->program_id)->where('user_id', $request->coach_id)->exists()) {
            return response()->json(['success' => false, 'msg' => 'Program Already SHared With This Coach']);
        }
        ProgramBuilderShare::create([
            'program_builder_id' => $request->program_id,
            'user_id' => $request->coach_id,
        ]);

        $name="Program Shared";
        $message="Program ".ProgramBuilder::find($request->program_id)->title." Was Shared";
        $url="";
        $type="ProgramShared";
        $this->sendNotification($request->coach_id,$name,$message,$url,$type);

        return response()->json(['success' => true, 'msg' => 'Program Shared']);
    }

    public function un_share_program_with_coach(Request $request)
    {
        $user = ProgramBuilderShare::find($request->id);
        $name="Program Share Removed";
        $message="Program ".ProgramBuilder::find($user->program_builder_id)->title." Share Was Removed";
        $url="";
        $type="ProgramShareRemoved";
        $this->sendNotification($user->user_id,$name,$message,$url,$type);
        $user->delete();
        return response()->json(['success' => true, 'msg' => 'Client Share Deleted']);
    }

    public function sharedProgramCoaches($id=0)
    {

        $users = ProgramBuilder::with('programBuilderShares.user')->where('created_by',Auth::user()->id)->where('id', $id)->get()->first();

        return new ProgramShareResource($users->programBuilderShares);
    }
}
