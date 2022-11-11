<?php

namespace App\Http\Controllers\N10Controllers;

use App\Models\WarmupVideo;
use Illuminate\Http\Request;
use App\Models\WarmupBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CoachClientResource;
use App\Models\ClientCoach;

class CoachClientController extends Controller
{
    public function index()
    {
        $page_heading = 'Your Clients';
        $sub_page_heading = collect(['User', 'CoachClients']);
        $data = new ClientCoach();
        return view('N10Pages.CoachClient.index', compact('page_heading', 'sub_page_heading', 'data'));
    }

    public function list()
    {
        $users = ClientCoach::with('user.userAthleticType')->get();
        return new CoachClientResource($users);
    }


}
