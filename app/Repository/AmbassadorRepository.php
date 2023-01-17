<?php

namespace App\Repository;

use App\Filters\AmbassadorFilter;
use App\Models\Ambassador;
use App\Repository\Interfaces\AmbassadorRepositoryInterface;

class AmbassadorRepository implements AmbassadorRepositoryInterface
{
    private $model;

    /**
     * RoleRepository constructor.
     *
     * @param Ambassador $model
     */
    public function __construct(Ambassador $model)
    {
        $this->model = $model;
    }

    /**
     *  @param int $count
     *  @param bool $paginate
     * @return object
     */
    public function all(int $count, bool $paginate = true): object
    {
        $filter = new AmbassadorFilter(Request());
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
     * @param Ambassador  $model
     * @param array $attributes
     * @return object
     */
    public function update(Ambassador $model, array $attributes): object
    {
        $model->update($attributes);
        return $model;
    }

    /**
     * @param int $model_id
     * @return object
     */
    public function find($model_id): ?object
    {
        return $this->model->find($model_id);
    }
}