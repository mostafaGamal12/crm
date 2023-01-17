<?php

namespace App\Filters;

use Carbon\Carbon;

class AmbassadorFilter extends Filters
{
    protected $var_filters = [
        'action', 'name', 'created_at_from', 'created_at_to', 'sort_field', 'phone', 'job_title', 'id_number', 'company', 'user_id', 'active'
    ];

    public function user_id($value)
    {
        return $this->builder->where('user_id', $value);
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

    public function phone($value)
    {
        return $this->builder->where('phone', 'like', "%$value%");
    }
    public function id_number($value)
    {
        return $this->builder->where('id_number', 'like', "%$value%");
    }
    public function company($value)
    {
        return $this->builder->where('company', 'like', "%$value%");
    }
    public function job_title($value)
    {
        return $this->builder->where('job_title', 'like', "%$value%");
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