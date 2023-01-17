<?php

namespace App\Models;

use App\Filters\Filters;
use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use CompanyTrait;
    protected $guarded = [];
    protected $with = ['city'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }
}
