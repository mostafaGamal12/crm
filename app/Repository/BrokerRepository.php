<?php

namespace App\Repository;

use App\Filters\ProkerFilter;
use App\Models\Broker;
use App\Repository\Interfaces\BrokerRepositoryInterface;

class BrokerRepository implements BrokerRepositoryInterface
{
    private $model;

    /**
     * RoleRepository constructor.
     *
     * @param Broker $model
     */
    public function __construct(Broker $model)
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
        $filter = new ProkerFilter(Request());
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
     * @param Broker  $model
     * @param array $attributes
     * @return object
     */
    public function update(Broker $model, array $attributes): object
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