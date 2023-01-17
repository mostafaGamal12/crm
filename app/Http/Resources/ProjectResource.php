<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'id'                     => $this->id ?? null,
            'name'                   => $this->name ?? null,
            'description'            => $this->description ?? null,
            'country_id'             => $this->country_id ?? null,
            'governorate_id'         => $this->governorate_id ?? null,
            'city_id'                => $this->city_id ?? null,
            'district_id'            => $this->district_id ?? null,
            'location'               => $this->location ?? null,
            'map_url'                => $this->map_url ?? null,
            'down_payment'           => $this->down_payment ?? null,
            'commission_per_million' => $this->commission_per_million ?? null,
            'area'                   => $this->area ?? null,
            'logo'                   => $this->logo ?? null,
            'brochure'               => $this->brochure ?? null,
            'master_plane_image'     => $this->master_plane_image ?? null,
            'installment_image'      => $this->installment_image ?? null,
            'pdf'                    => $this->pdf ?? null,
            'images'                 => $this->images ?? null,
            'phases'                 => $this->phases ?? null,
            'features'               => $this->features ?? null,
            'types'                  => $this->types ?? null,
            'district'               => $this->district ?? null,
//            'companies'              => $this->companies  ?? null,
            'created_at'             => $this->created_at  ?? null,
            'updated_at'             => $this->updated_at  ?? null,
        ];
    }
}
