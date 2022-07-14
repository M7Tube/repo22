<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class TemplateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'template_id' => $this->template_id,
            'name' => $this->name,
            'desc' => $this->desc,
            'pic' => 'https://c-rpt.com/storage/app/public/images/' . $this->pic,
            'instructions' => $this->instructions,
            'signatures' => $this->signatures,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ];
    }
}
