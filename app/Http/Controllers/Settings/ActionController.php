<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Http\Resources\ActionResource;
use Illuminate\Http\Request;
use App\Repository\Interfaces\ActionRepositoryInterface;
use App\Traits\LogTrait;

class ActionController extends Controller
{
    use LogTrait;
    private $ActionRepository;

    public function __construct(ActionRepositoryInterface $ActionRepository)
    {
        $this->ActionRepository = $ActionRepository;
    }

    /**
     * @param $count
     * @return Collection
     */
    public function index()
    {

        try {
            $paginate = Request()->paginate ?? true;
            $count = Request()->count ?? 20;
            $actions = $this->ActionRepository->all($count, $paginate);

            return $this->success_response(__('Success'), json_decode(ActionResource::collection($actions)->response()->getContent()), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param UserRequest $request
     * @return object
     */
    public function store(ActionRequest $request): object
    {
        try {
            $action = $this->ActionRepository->create($request->toArray());
            $action->roles()->attach($request->roles);
            $action->companies()->attach($request->companies);
            $old = $action->getRawOriginal();
            $this->createLog($action, $old, 'create');
            return $this->success_response(__('Success'), new ActionResource($action), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }

    /**
     * @param array $request
     * @param int  $id
     * @return object
     */
    public function update(ActionRequest $request, $id)
    {
        try {
            $model = $this->ActionRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }
            $old = $model->getRawOriginal();
            $action = $this->ActionRepository->update($model, $request->toArray());
            if ($request->has('roles'))
                $action->roles()->sync($request->roles);
            if ($request->has('companies'))
                $action->companies()->sync($request->companies);
            $this->createLog($action, $old, 'update');
            return $this->success_response(__('Success'), new ActionResource($action), null);
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
            $action = $this->ActionRepository->find($id);
            if (!$action) {
                return $this->fail_response(__("Not Found"), 404);
            }
            return $this->success_response(__('Success'),  new ActionResource($action), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}