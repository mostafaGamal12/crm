<?php

namespace App\Repository;

use App\Filters\CountryFilter;
use App\Models\Country;
use App\Repository\Interfaces\CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{
    private $model;

    /**
     * CountryRepository constructor.
     *
     * @param Country $model
     */
    public function __construct(Country $model)
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
        $filter = new CountryFilter(Request());
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
     * @param Country  $model
     * @param array $attributes
     * @return object
     */
    public function update(Country $model, array $attributes): object
    {
        $model->update($attributes);
        return $model;
    }

    /**
     * @param int $model_id
     * @return object
     */
    public function delete($model_id): ?object
    {
        return $this->model->destroy($model_id);
    }
}
