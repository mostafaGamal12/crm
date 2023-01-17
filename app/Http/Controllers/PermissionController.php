<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Repository\Eloquent\Roler;
use App\Repository\Interfaces\PermissionRepositoryInterface;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    /**
     * @param int $count
     * @return object
     */
    public function index(): ?object
    {
        try {
            $paginate = Request()->paginate ?? true;
            $count = Request()->count ?? 20;
            $permissions = $this->permissionRepository->all($count, $paginate);

            return $this->success_response(__('Success'),  $permissions, 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}