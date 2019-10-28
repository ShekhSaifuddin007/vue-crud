<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($student) {
                return [
                    'id' => $student->id,
                    'student' => $student->name,
                    'email' => $student->email,
                    'mobile' => $student->phone,
                    'address' => $student->address
                ];
            }),
        ];
    }
}
