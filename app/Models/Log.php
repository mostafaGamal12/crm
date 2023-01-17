<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Filters\Filters;
use App\Traits\CompanyTrait;

class Log extends Model
{
    use CompanyTrait;
    protected $connection = 'mongodb';
    protected $fillable = [
        'user_id', 'email', 'model', 'model_id', 'model_take_action_name', 'model_take_action_id', 'action', 'message', 'created_at'
    ];

    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }
}