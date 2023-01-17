<?php

namespace App\Traits;


trait CompanyTrait
{
    public function companies()
    {
        return $this->morphToMany("App\Models\Company", 'companieable');
    }
}