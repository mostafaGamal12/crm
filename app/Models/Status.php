<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use App\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use  RoleTrait, CompanyTrait;
    // protected $with = ['roles'];
    protected $fillable = [
        'status',
        'color',
        'active',
    ];
}