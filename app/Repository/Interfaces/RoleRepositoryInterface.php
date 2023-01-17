<?php

namespace App\Repository\Interfaces;

use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
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

    public function create(array $attributes): object;

    /**
     * @param int  $model_id
     * @return object
     */
    public function find($mode_id): ?object;


    // public function delete($mode_id);

    /**
     * @param Role  $model
     * @param array $attributes
     * @return object
     */
    public function update(Role $model, array $attribute): object;
}