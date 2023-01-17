<?php

namespace App\Repository;

use App\Models\ProjectType;
use App\Repository\Interfaces\ProjectTypeRepositoryInterface;

class ProjectTypeRepository implements ProjectTypeRepositoryInterface
{
    private $model;

    /**
     * ProjectTypeRepository constructor.
     *
     * @param ProjectType $model
     */
    public function __construct(ProjectType $model)
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
     * @param ProjectType  $model
     * @param array $attributes
     * @return object
     */
    public function update(ProjectType $model, array $attributes): object
    {
        $model->update($attributes);
        return $model;
    }

    /**
     * @param int $model_id
     * @return int
     */
    public function delete($model_id): ?object
    {
        return $this->model->destroy($model_id);
    }
}
