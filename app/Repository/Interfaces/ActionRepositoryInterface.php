<?php

namespace App\Repository\Interfaces;

use App\Models\Action;

interface ActionRepositoryInterface
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

    /**
     * @param array $attributes
     * @return object
     */
    public function create(array $attributes): object;


    // public function delete($mode_id);

    /**
     * @param Action  $model
     * @param array $attributes
     * @return object
     */
    public function update(Action $model, array $attribute): object;


    /**
     * @param int  $model_id
     * @return object
     */
    public function find($mode_id): ?object;
}