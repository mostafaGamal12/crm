<?php

namespace App\Models;

use App\Filters\Filters;
use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use CompanyTrait;
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


}
