<?php

namespace App\Repository;

use App\Models\Image;
use App\Repository\Interfaces\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    private $model;

    /**
     * ImageRepository constructor.
     *
     * @param Image $model
     */
    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    /**
     *  @param int $count
     *  @param bool $paginate
     * @return object
     */
    public function all(int $count, bool $paginate): object
    {
        if ($paginate == true) {
            return $this->model->paginate($count);
        }
        return $this->model->get();
    }

    /**
     * @param array $attributes
     * @return object
     */
    public function create(array $attributes): object
    {
        return $this->model->create($attributes);
    }
    /**
     * @param int $model_id
     * @return object
     */
    public function find($model_id): ?object
    {
        return $this->model->find($model_id);
    }

    /**
     * @param Image $model_id
     * @return int
     */
    public function delete($model_id): ?int
    {
        return $this->model->destroy($model_id);
    }
}