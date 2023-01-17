<?php

namespace App\Filters;

use Carbon\Carbon;

class UserFilter extends Filters
{
    protected $var_filters = [
        'first_name', 'last_name', 'email', 'active', 'phone', 'job_title', 'job_title', 'created_at_from', 'created_at_to', 'sort_field'
    ];

    public function first_name($value)
    {
        return $this->builder->where('first_name', 'like', "%$value%");
    }
    public function last_name($value)
    {
        return $this->builder->where('last_name', 'like', "%$value%");
    }
    public function email($value)
    {
        return $this->builder->where('email', 'like', "%$value%");
    }
    public function phone($value)
    {
        return $this->builder->where('phone', 'like', "%$value%");
    }
    public function job_title($value)
    {
        return $this->builder->where('job_title', 'like', "%$value%");
    }
    public function active($value)
    {
        return $this->builder->where('active', $value);
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