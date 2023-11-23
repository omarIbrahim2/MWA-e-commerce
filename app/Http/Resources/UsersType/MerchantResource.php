<?php

namespace App\Http\Resources\UsersType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
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
            "image" => $this->img,
           "merchant" => new UserResource($this->whenLoaded("user")),
        ];;
    }
}
