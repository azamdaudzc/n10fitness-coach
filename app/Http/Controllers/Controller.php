<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function updateprofile(Request $request, $file)
    {
        $p = $request->input();
        $path = '';

        if ($request->file($file)) {
            $request->validate([
                $file => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imagePath = $request->file($file);
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file($file)->storeAs('public/profileimage', time() . $imageName);
            $path = str_replace('public/', '', $path);
            $path=url('/').'/storage'.'/'.$path;
        }
        return $path;
    }


    public function saveThumbnailImage(Request $request, $file)
    {

        $path = '';

        if ($file) {
            // $request->validate([
            //     $file => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            $imagePath = $file;
            $imageName = $imagePath->getClientOriginalName();
            $path = $file->storeAs('public/thumbnailimage', time() . $imageName);
            $path = str_replace('public/', '', $path);
            $path=url('/').'/storage'.'/'.$path;
        }
        return $path;
    }

    function sendNotification($user_id,$name,$message,$url = null,$type = null){
        Notification::create([
            'user_id' => $user_id,
            'name' => $name,
            'message' => $message,
            'url' => $url,
        ]);

    }
}
