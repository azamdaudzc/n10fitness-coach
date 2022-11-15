<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $users = [];
        if ($this->resource->count() > 0) {
            foreach ($this->resource as $user) {
                $picture = $user->user->avatar != null ? $user->user->avatar : asset('/assets/media/avatars/blank.png');
                $userAvatar = '<div class="d-flex align-items-center">
                            <div class="symbol symbol-35px symbol-circle">
                                    <img alt="Pic" src="' . $picture . '"
                                         style=" object-fit: cover;"/>
                            </div>
                            <div class="text-gray-800 text-hover-primary mb-1 ms-5">
                                ' . $user->user->first_name . ' ' . $user->user->last_name . '
                                <div class="fw-semibold text-muted">' . $user->user->email . '</div>
                            </div>
                            <!--end::Details-->
                        </div>';


                $actions = '
                <a class="btn btn-danger btn-sm delete_record" data-id="' . $user->id . '" href="javascript:void(0);">Remove</a>

                ';
                $athletic_type = $user->user->userAthleticType == null ? '' : $user->user->userAthleticType->name;
                $age = $user->user->age . ' Years';
                $height = $user->user->height;
                $gender = $user->user->gender;
                $users[] = [
                    'user' => $userAvatar,
                    'athletic_type' => $athletic_type,
                    'age' => $age,
                    'height' => $height,
                    'gender' => $gender,
                    'actions' => $actions

                ];
            }
        }

        return [
            'draw' => 1,
            'recordsTotal' => count($users),
            'recordsFiltered' => count($users),
            'data' => $users
        ];
    }
}
