<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WarmupBuilderResource extends JsonResource
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
                $name = $setting->name;
                $description = $setting->description;
                $instructions = $setting->instructions;

                $actions = '
                            <div class="dropdown">
                              <button class="btn btn-active-dark btn-sm dropdown-toggle" type="button" id="actionsMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="actionsMenu">

                                   <li >
                                    <a class="dropdown-item " data-id="' . $setting->id . '" href="' . route('warmup.builder.create-edit', $setting->id) . '" >Edit</a>
                                </li>
                                <li >
                                <a class="dropdown-item create_new_off_canvas_modal view_record" data-id="' . $setting->id . '" href="javascript:void(0);" >View</a>
                            </li>
                                <li>
                                    <a class="dropdown-item delete_record" data-id="' . $setting->id . '" href="javascript:void(0);">Delete</a>
                                </li>

                              </ul>
                            </div>
                ';

                $status='<div class="badge badge-light-primary h-40px">Processing</div>';
                if($setting->approved_by>0){
                    $status='<div class="badge badge-light-success h-40px">Approved</div>';
                }
                else if($setting->rejected_by>0){
                    $status='<div class="badge badge-light-danger h-40px">Rejected</div>';
                }
                $settings[] = [
                    'status' => $status,
                    'name' => $name,
                    'description' => $description,
                    'instructions' => $instructions,
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
