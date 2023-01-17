<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name ?? null,
            'parent_id' => $this->parent_id ?? null,
            'active' => ($this->active == 0) ? 'InActive' : 'Active'  ?? null,
            'active_status' => $this->active   ?? null,
            'created_at' => $this->created_at  ?? null,
            'updated_at' => $this->updated_at  ?? null,
            'parent' => $this->parent->name  ?? null,
            'childrens' => $this->childrens  ?? null,
        ];
    }
}