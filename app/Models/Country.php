<?php

namespace App\Models;

use App\Filters\Filters;
use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Country extends Model
{
    use  Notifiable, HasRoles, CompanyTrait;

    protected $guarded = [];

    public function governorates()
    {
        return $this->hasMany(Governorate::class);
    }

    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }
}