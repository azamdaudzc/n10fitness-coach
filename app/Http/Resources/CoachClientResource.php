<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachClientResource extends JsonResource
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
                $athletic_type = $setting->user->userAthleticType->name;
                $age = $setting->user->age.' Years';
                $height = $setting->user->height;
                $gender = $setting->user->gender;
                $creatorPicture = $setting->user->avatar != null ?  $setting->user->avatar : asset('/assets/media/avatars/blank.png');



                $client = '<div class="d-flex align-items-center">
                <div class="symbol symbol-35px symbol-circle">
                        <img alt="Pic" src="' . $creatorPicture . '"
                        style=" object-fit: cover;"/>
                </div>
                <div class="text-gray-800 text-hover-primary mb-1 ms-5">
                    ' . $setting->user->first_name.' '. $setting->user->last_name. '
                    <div class="fw-semibold text-muted">' . $setting->user->email . '</div>

                </div>
                <!--end::Details-->
                </div>';



                $settings[] = [
                    'client' => $client,
                    'athletic_type' => $athletic_type,
                    'age' => $age,
                    'height' => $height,
                    'gender' => $gender,
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
