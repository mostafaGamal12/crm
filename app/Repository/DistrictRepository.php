<?php

namespace App\Repository;

use App\Filters\DistrictFilter;
use App\Models\District;
use App\Repository\Interfaces\DistrictRepositoryInterface;

class DistrictRepository implements DistrictRepositoryInterface
{
    private $model;

    /**
     * DistrictRepository constructor.
     *
     * @param District $model
     */
    public function __construct(District $model)
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
        $filter = new DistrictFilter(Request());
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
     * @param District  $model
     * @param array $attributes
     * @return object
     */
    public function update(District $model, array $attributes): object
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
