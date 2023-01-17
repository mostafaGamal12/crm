<?php

namespace App\Filters;

use Carbon\Carbon;

class CityFilter extends Filters
{
    protected $var_filters = [
        'name', 'governorate_id', 'created_at_from', 'created_at_to', 'sort_field'
    ];


    public function name($value)
    {
        return $this->builder->where('name', 'like', "%$value%");
    }
    public function governorate_id($value)
    {
        return $this->builder->where('governorate_id', $value);
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
