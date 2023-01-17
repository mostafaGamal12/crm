<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Repository\Eloquent\Roler;
use App\Repository\Interfaces\RoleRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Repository\Interfaces\PermissionRepositoryInterface;
use App\Traits\LogTrait;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    use LogTrait;
    private $roleRepository, $userRepository, $permissionRepository;

    public function __construct(RoleRepositoryInterface $roleRepository, UserRepositoryInterface $userRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
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
            $roles = $this->roleRepository->all($count, $paginate);

            return $this->success_response(__('Success'),  $roles, null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param int $id
     * @return object
     */
    public function show($id): object
    {
        try {
            $role = $this->roleRepository->find($id);
            if (!$role) {
                return $this->fail_response(__("Not Found"), 404);
            }
            return $this->success_response(__('Success'),  $role, 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }

    /**
     * @param array $request
     * @return object
     */
    public function store(RoleRequest $request): object
    {
        try {
            $role = $this->roleRepository->create($request->toArray());
            $role->syncPermissions($request->permissions);
            $old = $role->getRawOriginal();
            $this->createLog($role, $old, 'create');
            return $this->success_response(__('Success'),  $role, 'create new role');
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param array $request
     * @param int  $id
     * @return object
     */
    public function update(RoleRequest $request, $id)
    {
        $paginate = 0;
        $count = 0;
        try {
            $model = $this->roleRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }
            $old = $model->getRawOriginal();
            $role = $this->roleRepository->update($model, $request->toArray());
            $this->createLog($role, $old, 'update');
            $role->syncPermissions($request->permissions);
            $users = $this->userRepository->all($count, $paginate);
            foreach ($users as $key => $user) {
                $user->syncPermissions($request->permissions);
            }
            return $this->success_response(__('Success'),  $role, null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}