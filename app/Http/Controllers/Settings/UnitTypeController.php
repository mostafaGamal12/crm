<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Http\Requests\UnitTypeRequest;
use App\Http\Resources\UnitTypeResource;
use Illuminate\Http\Request;
use App\Repository\Interfaces\UnitTypeRepositoryInterface;
use App\Traits\LogTrait;

class UnitTypeController extends Controller
{
    use LogTrait;
    private $UnnitTypeRepository;

    public function __construct(UnitTypeRepositoryInterface $UnnitTypeRepository)
    {
        $this->UnnitTypeRepository = $UnnitTypeRepository;
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
            $unit_type = $this->UnnitTypeRepository->all($count, $paginate);

            return $this->success_response(__('Success'), json_decode(UnitTypeResource::collection($unit_type)->response()->getContent()), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param UserRequest $request
     * @return object
     */
    public function store(UnitTypeRequest $request): object
    {
        try {
            $unit_type = $this->UnnitTypeRepository->create($request->toArray());
            $unit_type->roles()->attach($request->roles);
            $unit_type->companies()->attach($request->companies);
            $old = $unit_type->getRawOriginal();
            $this->createLog($unit_type, $old, 'create');
            return $this->success_response(__('Success'), new UnitTypeResource($unit_type), null);
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
            $model = $this->UnnitTypeRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }
            $old = $model->getRawOriginal();
            $unit_type = $this->UnnitTypeRepository->update($model, $request->toArray());
            if ($request->has('roles'))
                $unit_type->roles()->sync($request->roles);
            if ($request->has('companies'))
                $unit_type->companies()->sync($request->companies);

            $this->createLog($unit_type, $old, 'update');
            return $this->success_response(__('Success'), new UnitTypeResource($unit_type), null);
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
            $unit_type = $this->UnnitTypeRepository->find($id);
            if (!$unit_type) {
                return $this->fail_response(__("Not Found"), 404);
            }
            return $this->success_response(__('Success'),  new UnitTypeResource($unit_type), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}