<?php

namespace App\Http\Resources\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            'address' => $this->address,
            'phoneNumber' => $this->phone_number,
        ];
    }
}
