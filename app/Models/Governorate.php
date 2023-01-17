<?php

namespace App\Models;

use App\Filters\Filters;
use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use CompanyTrait;
    protected $guarded = [];
    protected $with = ['country'];

    public function cities()
    {
    	return $this->hasMany(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }
}
