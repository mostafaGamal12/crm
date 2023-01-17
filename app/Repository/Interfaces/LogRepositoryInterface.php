<?php

namespace App\Repository\Interfaces;

interface LogRepositoryInterface
{
    /**
     * @param int $count
     * @param bool $paginate
     * @return object
     */
    public function all(int $count, bool $paginate);

    /**
     * @param array $attributes
     * @return object
     */
    public function create(array $attributes): ?object;


    /**
     * @param int  $model_id
     * @return object
     */

    public function find(int $mode_id): ?object;
}