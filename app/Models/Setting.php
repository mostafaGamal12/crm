<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use CompanyTrait;

    protected $fillable = [
        'key',
        'value',
        'module',
    ];
}