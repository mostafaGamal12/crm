<?php

namespace App\Filters;

use Carbon\Carbon;

class CompanyFilter extends Filters
{
    protected $var_filters = [
        'parent_id', 'name', 'created_at_from', 'created_at_to', 'sort_field',  'active'
    ];

    public function parent_id($value)
    {
        return $this->builder->where('parent_id', $value);
    }
    public function name($value)
    {
        return $this->builder->where('name', 'like', "%$value%");
    }
    public function created_at_from($value)
    {
        return $this->builder->where('created_at', ">=", new Carbon($value));
    }
    public function created_at_to($value)
    {
        return $this->builder->where('created_at', "<=", new Carbon($value));
    }
  
    public function active($value)
    {
        return $this->builder->where('active', $value);
    }
    public function sort_field($value)
    {
        $sort_type = \Request()->input('sort_type') ?? 'desc';
        return $this->builder->orderBy($value, $sort_type);
    }
}