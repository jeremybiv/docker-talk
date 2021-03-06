<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Topic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        /*
        return [
            // relationships
            'subject' => $this->subject,
            'description' => $this->description,
            'email' => $this->email,
            'date' => $this->date,
            'status' => (int) $this->status,
        ];*/
    }
}
