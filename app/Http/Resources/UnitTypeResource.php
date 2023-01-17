<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitTypeResource extends JsonResource
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
            'id' => $this->id ?? null,
            'type' => $this->type ?? null,
            'active' => ($this->active == 0) ? 'InActive' : 'Active'  ?? null,
            'active_status' => $this->active   ?? null,
            'roles' => $this->roles ?? null,
            'updated_at' => $this->updated_at  ?? null,
            'created_at' => $this->created_at  ?? null,
             'companies' => $this->companies  ?? null,
        ];
    }
}