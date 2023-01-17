<?php

namespace App\Filters;

use App\Models\Log;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;

class LogFilter extends Filters
{
    protected $var_filters = [
        'action', 'email', 'created_at_from', 'created_at_to', 'sort_field'
    ];

    public function action($value)
    {
        return $this->builder->where('action', 'like', "%$value%");
    }
    public function email($value)
    {
        return $this->builder->where('email', 'like', "%$value%");
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