<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Http\Resources\StatusResource;
use Illuminate\Http\Request;
use App\Repository\Interfaces\StatusRepositoryInterface;
use App\Traits\LogTrait;

class StatusController extends Controller
{
    use LogTrait;
    private $StatusRepository;

    public function __construct(StatusRepositoryInterface $StatusRepository)
    {
        $this->StatusRepository = $StatusRepository;
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
            $Statuss = $this->StatusRepository->all($count, $paginate);

            return $this->success_response(__('Success'), json_decode(StatusResource::collection($Statuss)->response()->getContent()), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param UserRequest $request
     * @return object
     */
    public function store(StatusRequest $request): object
    {
        try {
            $status = $this->StatusRepository->create($request->toArray());
            $status->roles()->attach($request->roles);
            $status->companies()->attach($request->companies);
            $old = $status->getRawOriginal();
            $this->createLog($status, $old, 'create');
            return $this->success_response(__('Success'), new StatusResource($status), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }

    /**
     * @param array $request
     * @param int  $id
     * @return object
     */
    public function update(StatusRequest $request, $id)
    {
        try {
            $model = $this->StatusRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }
            $old = $model->getRawOriginal();
            $status = $this->StatusRepository->update($model, $request->toArray());
            if ($request->has('roles'))
                $status->roles()->sync($request->roles);
            if ($request->has('companies'))
                $status->companies()->sync($request->companies);

            $this->createLog($status, $old, 'update');
            return $this->success_response(__('Success'), new StatusResource($status), null);
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
            $status = $this->StatusRepository->find($id);
            if (!$status) {
                return $this->fail_response(__("Not Found"), 404);
            }
            return $this->success_response(__('Success'),  new StatusResource($status), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}