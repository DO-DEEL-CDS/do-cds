<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class StateMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'phone_number' => $this->user->profile->phone_number,
            'instagram' => $this->user->profile->instagram_username,
            'facebook_link' => $this->user->facebook_link,
        ];
    }
}
