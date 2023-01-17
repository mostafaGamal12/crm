<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrokerResource extends JsonResource
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
            'owner_name' => $this->owner_name ?? null,
            'company_name' => $this->company_name ?? null,
            'company_phone' => $this->company_phone ?? null,
            'company_email' => $this->company_email ?? null,
            'commercial_register' => $this->commercial_register ?? null,
            'tax_card' => $this->tax_card ?? null,
            'active' => ($this->active == 0) ? 'InActive' : 'Active'  ?? null,
            'active_status' => $this->active   ?? null,
            'created_at' => $this->created_at  ?? null,
            'updated_at' => $this->updated_at  ?? null,
            'roles' => $this->roles  ?? null,
            'companies' => $this->companies  ?? null,
            'files' => $this->images  ?? null,
        ];
    }
}