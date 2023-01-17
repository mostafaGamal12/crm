<?php

namespace App\Repository;

use App\Models\Log;
use App\Repository\Interfaces\LogRepositoryInterface;
use Illuminate\Support\Collection;


class LogRepository implements LogRepositoryInterface
{
    private $model;

    /**
     * RoleRepository constructor.
     *
     * @param Log $model
     */
    public function __construct(Log $model)
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
     * @param int $model_id
     * @return object
     */
    public function find($model_id): ?object
    {
        return $this->model->find($model_id);
    }
}