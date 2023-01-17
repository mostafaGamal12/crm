<?php

namespace App\Repository;

use App\Filters\ProjectFilter;
use App\Models\Project;
use App\Repository\Interfaces\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    private $model;

    /**
     * ProjectRepository constructor.
     *
     * @param Project $model
     */
    public function __construct(Project $model)
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
        $filter = new ProjectFilter(Request());

        if ($paginate == true) {
            return $this->model->filter($filter)->paginate($count);
        }
        return $this->model->filter($filter)->get();
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
     * @param Project  $model
     * @param array $attributes
     * @return object
     */
    public function update(Project $model, array $attributes): object
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
