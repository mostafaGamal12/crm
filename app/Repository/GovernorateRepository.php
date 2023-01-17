<?php

namespace App\Repository;

use App\Filters\GovernorateFilter;
use App\Models\Governorate;
use App\Repository\Interfaces\GovernorateRepositoryInterface;

class GovernorateRepository implements GovernorateRepositoryInterface
{
    private $model;

    /**
     * GovernorateRepository constructor.
     *
     * @param Governorate $model
     */
    public function __construct(Governorate $model)
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
        $filter = new GovernorateFilter(Request());
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
     * @param Governorate  $model
     * @param array $attributes
     * @return object
     */
    public function update(Governorate $model, array $attributes): object
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
