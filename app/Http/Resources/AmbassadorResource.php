<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AmbassadorResource extends JsonResource
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
            'user_id' => $this->user_id ?? null,
            'agent_name' => $this->agent->name ?? null,
            'phone' => $this->phone ?? null,
            'job_title' => $this->job_title ?? null,
            'company' => $this->company ?? null,
            'id_photo' => $this->id_photo ?? null,
            'id_number' => $this->id_number ?? null,
            'commission' => $this->commission ?? null,
            'active' => ($this->active == 0) ? 'InActive' : 'Active'  ?? null,
            'active_status' => $this->active   ?? null,
            'created_at' => $this->created_at  ?? null,
            'updated_at' => $this->updated_at  ?? null,
            'roles' => $this->roles  ?? null,
            'companies' => $this->companies  ?? null,
        ];
    }
}