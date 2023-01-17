<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use App\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use  RoleTrait, CompanyTrait;
    protected $fillable = [
        'action',
        'active',
    ];
}