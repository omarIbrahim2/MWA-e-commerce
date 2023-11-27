<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "name"=> $this->productName,
            "item"=> $this->item->itemName,
            'category' => $this->item->cat->catName,
            "code" => $this->code,
            "describion" => $this->desc,
            "color" => $this->color,
            "dimension" => $this->dimension,
            "cc" => $this->cc,
            "weight" => $this->weight,
            "price" => $this->price,
            "discount" => $this->percentage,
            "image" => $this->img
        ];
    }
}
