<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramSharedResource extends JsonResource
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
                $setting=$setting->programBuilder;
                $name = $setting->title;
                $weeks = $setting->weeks;
                $days = $setting->days;

                $actions = '<a href="'.route('program.sharedwith.saveasyours',$setting->id).'"><button class="btn btn-primary">Save As Yours</button></a>';

                $status = '';
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
