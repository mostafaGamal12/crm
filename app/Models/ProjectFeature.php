<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class ProjectFeature extends Model
{
    use CompanyTrait;
    protected $guarded = [];

    public function projects()
    {
    	return $this->hasMany(Project::class);
    }


}
