<?php

namespace App\Repository;

use App\Models\Status;
use App\Repository\Interfaces\StatusRepositoryInterface;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StatusRepository implements StatusRepositoryInterface
{
    private $model;

    /**
     * RoleRepository constructor.
     *
     * @param Status $model
     */
    public function __construct(Status $model)
    {
        $this->model = $model;
    }

    /**
     *  @param int $count
     *  @param bool $paginate
     * @return object
     */
    public function all(int $count, bool $paginate = true): ?object
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
    public function create(array $attributes): ?object
    {
        return $this->model->create($attributes);
    }
    /**
     * @param Status  $model
     * @param array $attributes
     * @return object
     */
    public function update(Status $model, array $attributes): object
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