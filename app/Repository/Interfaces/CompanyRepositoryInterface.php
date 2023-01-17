<?php

namespace App\Repository\Interfaces;

use App\Models\Company;

interface CompanyRepositoryInterface
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

    /**
     * @param array $attributes
     * @return object
     */

    public function create(array $attributes): ?object;

    /**
     * @param City  $model
     * @param array $attributes
     * @return object
     */
    public function update(Company $model, array $attribute): object;


    /**
     * @param int $model_id
     * @return int
     */
     public function delete($mode_id);

}
