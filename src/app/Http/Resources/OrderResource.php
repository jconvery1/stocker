<?php

namespace App\Http\Resources;

use App\Models\StockOrder;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'notes' => $this->notes,
            'order_datetime' => $this->order_datetime,
            'user_id' => $this->user_id,
            'supplier_id' => $this->supplier_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
