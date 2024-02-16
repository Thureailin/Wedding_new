<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'id'=>$this->id,
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'customer_address' => $this->customer_address,
            'customer_email' => $this->customer_email,
            'recommendation' => $this->remark,
            'package_id' => $this->package_id,
            'dress_id' => $this->dress_id,
            'theme_id' => $this->theme_id,
            'date' => $this->date,
            'time' => $this->time,
            'status' => $this->status,
        ];
    }
}
