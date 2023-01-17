<?php

namespace App\Repository;

use App\Filters\UserFilter;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
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
        $filter = new UserFilter(Request());
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
     * @param User  $model
     * @param array $attributes
     * @return object
     */
    public function update(User $model, array $attributes): object
    {
        $model->update($attributes);
        return $model;
    }

    /**
     * @param User  $model
     * @param array $attributes
     * @return object
     */
    public function updateProfilePhoto(User $model, array $attributes): object
    {
        $model->update($attributes);
        return $model;
    }

    /**
     * @param User  $model
     * @param array $attributes
     * @return object
     */
    public function updatePassword(User $model, array $attributes): object
    {
        $model->update($attributes);
        return $model;
    }
}