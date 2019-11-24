<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'student' => $this->name,
            'email' => $this->email,
            'mobile' => $this->phone,
            'address' => $this->address,
            'image' => $this->image
        ];
    }
}
