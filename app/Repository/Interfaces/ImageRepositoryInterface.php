<?php

namespace App\Repository\Interfaces;

use App\Models\Image;

interface ImageRepositoryInterface
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


    /**
     * @param Image $model_id
     * @return int
     */
    public function delete($model_id): ?int;
}