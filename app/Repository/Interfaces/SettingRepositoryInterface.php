<?php

namespace App\Repository\Interfaces;

use App\Models\Setting;

interface SettingRepositoryInterface
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

    // public function create(array $attributes): object;

    // public function delete($mode_id);

    /**
     * @param Setting  $model
     * @param array $attributes
     * @return object
     */
    public function update(Setting $model, array $attribute): object;


    /**
     * @param int  $model_id
     * @return object
     */
    public function find($mode_id): ?object;
}