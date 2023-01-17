<?php

namespace App\Repository\Interfaces;

use App\Models\ProjectFeature;

interface ProjectFeatureRepositoryInterface
{
    /**
     * @param int $count
     * @param bool $paginate
     * @return object
     */
    public function all(int $count, bool $paginate);

    /**
     * @param int $model_id
     * @return object
     */
    public function find(int $model_id): ?object;

    /**
     * @param array $attributes
     * @return object
     */

    public function create(array $attributes): ?object;

    /**
     * @param ProjectFeature  $model
     * @param array $attributes
     * @return object
     */
    public function update(ProjectFeature $model, array $attribute): object;


    /**
     * @param int $model_id
     * @return int
     */
     public function delete($mode_id);

}
