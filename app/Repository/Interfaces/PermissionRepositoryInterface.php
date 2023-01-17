<?php

namespace App\Repository\Interfaces;

interface PermissionRepositoryInterface
{
    /**
     * @param int $count
     * @param bool $paginate
     * @return object
     */
    public function all(int $count, bool $paginate);



    /**
     * @param int  $model_id
     * @return object
     */
    public function find($mode_id): ?object;
}