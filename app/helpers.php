<?php

use App\Models\UserCheckin;
use App\Models\CheckinQuestion;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;


function getNotifications(){
    return Notification::where('user_id',Auth::user()->id)->where('read',0)->get();
}

function getNotificationCount(){
    return Notification::where('user_id',Auth::user()->id)->where('read',0)->count('id');
}
