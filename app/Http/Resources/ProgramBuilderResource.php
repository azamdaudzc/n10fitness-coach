<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramBuilderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $settings = [];
        if ($this->resource->count() > 0) {
            foreach ($this->resource as $setting) {
                $name = $setting->title;
                $weeks = $setting->weeks;
                $days = $setting->days;

                if($setting->created_by != Auth::user()->id){
                    $name = '<div class="d-flex align-items-center">
                            <div class="symbol symbol-35px symbol-circle">

                            </div>
                            <div class="text-gray-800 text-hover-primary mb-1 ms-5">
                                ' . $name . '<br>
                                <div class="badge badge-light-warning">Shared Program</div>
                            </div>
                            <!--end::Details-->
                        </div>';
                }

                $actions = '<div class="dropdown">
                              <button class="btn btn-active-dark btn-sm dropdown-toggle" type="button" id="actionsMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="actionsMenu">';

                if ($setting->created_by == Auth::user()->id) {
                    $actions .= ' <li >
                            <a class="dropdown-item " data-id="' . $setting->id . '" href="' . route('program.builder.create-edit', $setting->id) . '" >Edit</a>
                            </li>';

                            $actions.='
                            <li>
                            <a class="dropdown-item delete_record" data-id="' . $setting->id . '" href="javascript:void(0);">Delete</a>
                            </li>';
                }

                $actions.='<li >
                            <a class="dropdown-item " data-id="' . $setting->id . '" href="' . route('program.builder.view', $setting->id) . '" >View</a>
                            </li>';

                if($setting->approved_by>0){
                    $actions.='    <li >
                    <a class="dropdown-item " data-id="' . $setting->id . '" href="' . route('program.builder.assign-clients', $setting->id) . '" >Assign Clients</a>
                    </li>';
                    $actions.='    <li >
                    <a class="dropdown-item " data-id="' . $setting->id . '" href="' . route('program.share.index', $setting->id) . '" >Share</a>
                    </li>';
                }
                $actions .= ' </ul> </div>';

                $status = '<div class="badge badge-light-warning">Processing</div>';
                if ($setting->approved_by > 0) {
                    $status = '<div class="badge badge-light-success">Approved</div>';
                } else if ($setting->rejected_by > 0) {
                    $status = '<div class="badge badge-light-danger">Rejected</div>';
                }
                $settings[] = [
                    'status' => $status,
                    'name' => $name,
                    'weeks' => $weeks,
                    'days' => $days,
                    'createdAt' => Carbon::createFromFormat('Y-m-d H:i:s', $setting->created_at)->format('d M, Y h:i A'),
                    'actions' => $actions
                ];
            }
        }

        return [
            'draw' => 1,
            'recordsTotal' => count($settings),
            'recordsFiltered' => count($settings),
            'data' => $settings
        ];
    }
}
