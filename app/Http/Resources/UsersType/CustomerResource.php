<?php

namespace App\Http\Resources\UsersType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
   
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
           "customer" => new UserResource($this->whenLoaded("user")),
        ];
    }
}
