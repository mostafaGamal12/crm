<?php

namespace App\Filters;

use Carbon\Carbon;

class ProkerFilter extends Filters
{
    protected $var_filters = [
        'owner_name', 'company_name', 'created_at_from', 'created_at_to', 'sort_field', 'company', 'company_phone', 'company_email', 'tax_card', 'company', 'user_id', 'active'
    ];

    public function owner_name($value)
    {
        return $this->builder->where('owner_name', 'like', "%$value%");
    }
    public function company_name($value)
    {
        return $this->builder->where('company_name', 'like', "%$value%");
    }
    public function created_at_from($value)
    {
        return $this->builder->where('created_at', ">=", new Carbon($value));
    }
    public function created_at_to($value)
    {
        return $this->builder->where('created_at', "<=", new Carbon($value));
    }

    public function company_phone($value)
    {
        return $this->builder->where('company_phone', 'like', "%$value%");
    }
    public function company_email($value)
    {
        return $this->builder->where('company_email', 'like', "%$value%");
    }
    public function company($value)
    {
        return $this->builder->where('company', 'like', "%$value%");
    }

    public function tax_card($value)
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