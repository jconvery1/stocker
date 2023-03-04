<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'supplier_id' => $this->supplier_id,
            'price' => $this->price,
            'image' => $this->image,
            'gender' => $this->gender,
            'brand' => $this->brand,
            'colour' => $this->colour,
            'shoe_size' => $this->shoe_size,
            'material' => $this->material,
            'category' => $this->category,
            'stock_level' => $this->stock_level,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
