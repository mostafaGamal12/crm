<?php

namespace App\Traits;

use App\Services\FcmService;

trait RoleTrait
{
    public function Roles()
    {
        return $this->morphToMany("Spatie\Permission\Models\Role", 'roleable');
    }
}