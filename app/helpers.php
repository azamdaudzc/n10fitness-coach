<?php

use App\Models\UserCheckin;
use App\Models\Notification;
use App\Models\UserPermission;
use App\Models\CheckinQuestion;
use Illuminate\Support\Facades\Auth;


function getNotifications(){
    return Notification::where('user_id',Auth::user()->id)->where('read',0)->get();
}

function getNotificationCount(){
    return Notification::where('user_id',Auth::user()->id)->where('read',0)->count('id');
}

function canDeployPrograms(){
    return UserPermission::where('user_id',Auth::user()->id)->where('name','Program Deployment')->exists();

}



function notificationWhereToGo($type){
    $url=url('/');
    switch ($type) {
        case 'ExerciseLibraryApproved':
            $url=route('exercise.library.index').'?goto=1';
            break;
        case 'ExerciseLibraryRejected':
            $url=route('exercise.library.index').'?goto=3';
            break;
        case 'ProgramApproved':
            $url=route('program.builder.index').'?goto=1';
            break;
        case 'ProgramRejected':
            $url=route('program.builder.index').'?goto=3';
            break;
        case 'WarmupApproved':
            $url=route('warmup.builder.index').'?goto=1';
            break;
        case 'WarmupRejected':
            $url=route('warmup.builder.index').'?goto=3';
            break;
        case 'CoachClientAssigned':
            $url=url('/');
            break;
        case 'CoachClientRemoved':
            $url=url('/');
            break;
        case 'ProgramDayCompleted':
            $url=route('program.builder.index');
            break;
        case 'ExerciseLibraryCreated':
            $url=route('exercise.library.index').'?goto=2';
            break;
        case 'ProgramAssigned':
            $url=route('program.builder.index');
            break;
        case 'ProgramRemoved':
            $url=route('program.builder.index');
            break;
        case 'ProgramCreated':
            $url=route('program.builder.index');
            break;
        case 'ProgramShared':
            $url=route('program.builder.index');
            break;
        case 'ProgramShareRemoved':
            $url=route('program.builder.index');
            break;
        case 'WarmupCreated':
            $url=route('warmup.builder.index').'?goto=2';
            break;

        default:

            break;
     }
     return $url;
}
