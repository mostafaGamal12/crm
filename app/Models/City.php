<?php

namespace App\Models;

use App\Filters\Filters;
use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use CompanyTrait;
    protected $guarded = [];
    protected $with = ['governorate'];

    public function districts()
    {
    	return $this->hasMany(District::class);
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }
}
