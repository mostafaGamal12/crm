<?php

namespace App\Models;

use App\Filters\Filters;
use App\Traits\CompanyTrait;
use App\Traits\hasImages;
use App\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use CompanyTrait, RoleTrait, hasImages;
    protected $fillable = ['owner_name', 'company_name', 'active', 'company_phone', 'company_email', 'company_email', 'tax_card', 'commercial_register'];
    const File_TYPE_PDF = 'PDF';
    const max_file_size = 10240;

    public function scopeFilter($query, Filters $filter)
    {
        return $filter->apply($query);
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'broker_projects')->withPivot('commission');
    }
}