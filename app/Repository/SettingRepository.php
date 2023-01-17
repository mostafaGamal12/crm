<?php

namespace App\Repository;

use App\Models\Setting;
use App\Repository\Interfaces\SettingRepositoryInterface;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SettingRepository implements SettingRepositoryInterface
{
    private $model;

    /**
     * RoleRepository constructor.
     *
     * @param Setting $model
     */
    public function __construct(Setting $model)
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
    public function create(array $attributes): object
    {
        return $this->model->create($attributes);
    }
    /**
     * @param Setting  $model
     * @param array $attributes
     * @return object
     */
    public function update(Setting $model, array $attributes): object
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