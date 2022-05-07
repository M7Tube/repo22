<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HandOver extends JsonResource
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
            'note' => $this->note,
            'name' => $this->name,
            'signture1' => 'https://c-rpt.com/storage/app/public/images/' . $this->signture1,
            'signture1Name' => $this->signture1Name,
            'signture2' => 'https://c-rpt.com/storage/app/public/images/' . $this->signture2,
            'signture2Name' => $this->signture2Name,
        ];
        // return parent::toArray($request);
    }
}
