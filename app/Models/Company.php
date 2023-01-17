<?php

namespace App\Models;

use App\Filters\Filters;
use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use CompanyTrait;
    protected $fillable = ['parent_id', 'name', 'active'];


    public function parent()
    {
        return $this->belongsTo(Company::class, 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Company::class, 'parent_id');
    }
    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }
}