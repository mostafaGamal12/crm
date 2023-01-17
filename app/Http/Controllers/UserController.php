<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Repository\Interfaces\RoleRepositoryInterface;
use App\Repository\Interfaces\LogRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Traits\LogTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use LogTrait;
    private $userRepository, $roleRepository;

    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    /**
     * @param int $count
     * @return object
     */
    public function index(): object
    {
        try {
            $paginate = Request()->paginate ?? true;
            $count = Request()->count ?? 20;;
            $users = $this->userRepository->all($count, $paginate);

            return $this->success_response(__('Success'), json_decode(UserResource::collection($users)->response()->getContent()), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param UserRequest $request
     * @return object
     */
    public function store(UserRequest $request): object
    {
        try {
            $data = Request()->all();
            if (isset(Request()->profile_photo)) {
                $data['profile_photo'] = UplaodPhoto(Request()->profile_photo, 'profile');
            }
            $data['password'] = Hash::make(Request()->password);
            $role = $this->roleRepository->find(Request()->role);
            $user = $this->userRepository->create($data);
            $user->syncRoles($role);
            $user->syncPermissions($role->permissions);
            $user->companies()->attach($request->companies);
            $old = $user->getRawOriginal();
            $this->createLog($user, $old, 'create');
            return $this->success_response(__('Success'),   new UserResource($user), null);
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
            $user = $this->userRepository->find($id);
            if (!$user) {
                return $this->fail_response(__("Not Found"), 404);
            }
            return $this->success_response(__('Success'),    new UserResource($user), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }

    /**
     * @param UserRequest $request
     * @param int  $id
     * @return object
     */
    public function update(UserRequest $request, $id)
    {
        $data = Request()->all();
        try {
            $model = $this->userRepository->find($id);
            if (!$model) 
                return $this->fail_response(__("Not Found"));
            
          
            $data['password'] = $model->password;
            $old = $model->getRawOriginal();
            $user = $this->userRepository->update($model, $data);

            if ($request->has('role')){
                $role = Role::find($request->input("role"));
                $user->roles()->sync($request->role);
                $user->syncPermissions($role->permissions);
            }

            if ($request->has('companies'))
            $user->companies()->sync($request->companies);

            $this->createLog($user, $old, 'update');
            return $this->success_response(__('Success'),  new UserResource($user), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }


    /**
     * @param int  $id
     * @return object
     */
    public function updateProfilePhoto($id)
    {
        Request()->validate([
            'profile_photo' => ['required',  "mimes:jpeg,bmp,jpg,png", 'image', 'file'],
        ]);

        $data = Request()->all();
        try {
            $model = $this->userRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }

            if (isset(Request()->profile_photo)) {
                $data['profile_photo'] = UplaodPhoto(Request()->profile_photo, 'profile');
            } else {
                $data['profile_photo'] = $model->profile_photo;
            }
            $old = $model->getRawOriginal();
            $user = $this->userRepository->update($model, $data);
            $this->createLog($user, $old, 'update');
            return $this->success_response(__('Success'),  new UserResource($user), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param int  $id
     * @return object
     */
    public function updatePassword($id)
    {
        Request()->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $data = Request()->all();
        try {
            $model = $this->userRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }

            $data = Request()->all();
            $data['password'] = Hash::make(Request()->password);
            $old = $model->getRawOriginal();
            $user = $this->userRepository->update($model, $data);
            $this->createLog($user, $old, 'update');
            return $this->success_response(__('Success'),  new UserResource($user), 200);
        } catch (\Throwable $th) {
            Log::error('error  ' . $th);
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param array  Request
     * @return object
     */
    public function updateMyPassword()
    {
        Request()->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'old_password' => ['required'],
        ]);

        $data = Request()->all();
        try {
            $model = Auth::user();

            if (Hash::check(Request()->old_password, $model->password)) {
                $data = Request()->all();
                $data['password'] = Hash::make(Request()->password);
                $user = $this->userRepository->update($model, $data);
            } else {
                return $this->fail_response(__('Old Password Does not match'));
            }
            return $this->success_response(__('Success'),  new UserResource($user), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }

    /**
     * @param  array  Request
     * @return object
     */
    public function updateMyProfilePhoto()
    {
        Request()->validate([
            'profile_photo' => ['nullable',  "mimes:jpeg,bmp,png", 'image', 'file'],
        ]);

        $data = Request()->all();
        try {
            $model = Auth::user();

            if (isset(Request()->profile_photo)) {
                $data['profile_photo'] = UplaodPhoto(Request()->profile_photo, 'profile');
            } else {
                $data['profile_photo'] = $model->profile_photo;
            }
            $user = $this->userRepository->update($model, $data);
            return $this->success_response(__('Success'),  new UserResource($user), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param  UserRequest  $request
     * @return object
     */
    public function updateMyProfile(UserRequest $request)
    {
        $data = Request()->except('role');
        try {
            $model = Auth::user();
            $data['password'] = $model->password;
            $user = $this->userRepository->update($model, $data);
            return $this->success_response(__('Success'),  new UserResource($user), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}