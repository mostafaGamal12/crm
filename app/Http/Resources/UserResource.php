<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name ?? null,
            'last_name' => $this->last_name ?? null,
            'email' => $this->email  ?? null,
            'phone' => $this->phone  ?? null,
            'profile_photo' => $this->profile_photo  ?? null,
            'about' => $this->about  ?? null,
            'linkedin' => $this->linkedin  ?? null,
            'facebook' => $this->facebook  ?? null,
            'instgram' => $this->instgram  ?? null,
            'twitter' => $this->twitter  ?? null,
            'job_title' => $this->job_title  ?? null,
            'active' => ($this->active == 0) ? 'InActive' : 'Active'  ?? null,
            'active_status' => $this->active   ?? null,
            'first_login' => $this->first_login   ?? null,
            'created_at' => $this->created_at  ?? null,
            'updated_at' => $this->updated_at  ?? null,

            "roles" => $this->roles,
            "permissions" => $this->permissions,
            "companies" => $this->companies,


        ];
    }
}