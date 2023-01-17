<?php

namespace App\Models;

use App\Filters\Filters;
use App\Traits\CompanyTrait;
use App\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    use RoleTrait, CompanyTrait;
    protected $fillable = ['user_id', 'name', 'phone', 'job_title', 'company', 'id_photo', 'id_number', 'commission', 'active'];

    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }

    public function agent()
    {
        return $this->belongsTo(User::class);
    }
}