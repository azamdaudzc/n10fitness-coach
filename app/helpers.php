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
