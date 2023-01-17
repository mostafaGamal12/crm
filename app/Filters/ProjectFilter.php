<?php

namespace App\Filters;

use Carbon\Carbon;

class ProjectFilter extends Filters
{
    protected $var_filters = [
        'name', 'country_id', 'governorate_id', 'city_id', 'district_id', 'area',
        'feature_id', 'type_id', 'created_at_from', 'created_at_to', 'sort_field'
    ];

    public function name($value)
    {
        return $this->builder->where('name', 'like', "%$value%");
    }
    public function country_id($value)
    {
        return $this->builder->where('country_id', $value);
    }
    public function governorate_id($value)
    {
        return $this->builder->where('governorate_id', $value);
    }
    public function city_id($value)
    {
        return $this->builder->where('city_id', $value);
    }
    public function district_id($value)
    {
        return $this->builder->where('district_id', $value);
    }
    public function area($value)
    {
        return $this->builder->where('area', $value);
    }
    public function feature_id($value)
    {
        return $this->builder->whereHas('features',function ($query) use ($value){
            $query->where('feature_id',$value);
        });
    }
    public function type_id($value)
    {
        return $this->builder->whereHas('types',function ($query) use ($value){
            $query->where('type_id',$value);
        });
    }
    public function created_at_from($value)
    {
        return $this->builder->where('created_at', ">=", new Carbon($value));
    }
    public function created_at_to($value)
    {
        return $this->builder->where('created_at', "<=", new Carbon($value));
    }
    public function sort_field($value)
    {
        $sort_type = \Request()->input('sort_type') ?? 'desc';
        return $this->builder->orderBy($value, $sort_type);
    }
}
