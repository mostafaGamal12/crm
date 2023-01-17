<?php

namespace App\Repository\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    /**
     * @param int $count
     * @param bool $paginate
     * @return object
     */
    public function all(int $count, bool $paginate);

    /**
     * @param int $model_id
     * @return object
     */
    public function find(int $model_id): ?object;

    // public function delete($mode_id);
    /**
     * @param array $attributes
     * @return object
     */

    public function create(array $attributes): ?object;


    /**
     * @param User  $model
     * @param array $attributes
     * @return object
     */
    public function updateProfilePhoto(User $model, array $attribute): object;
    /**
     * @param User  $model
     * @param array $attributes
     * @return object
     */
    public function updatePassword(User $model, array $attribute): object;

    /**
     * @param User  $model
     * @param array $attributes
     * @return object
     */
    public function update(User $model, array $attribute): object;
}