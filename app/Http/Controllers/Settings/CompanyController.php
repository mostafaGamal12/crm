<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;
use App\Repository\Interfaces\CompanyRepositoryInterface;
use App\Traits\LogTrait;

class CompanyController extends Controller
{
    use LogTrait;
    private $CompanyRepository;

    public function __construct(CompanyRepositoryInterface $CompanyRepository)
    {
        $this->CompanyRepository = $CompanyRepository;
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
            $Companys = $this->CompanyRepository->all($count, $paginate);
            return $this->success_response(__('Success'), json_decode(CompanyResource::collection($Companys)->response()->getContent()), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param UserRequest $request
     * @return object
     */
    public function store(CompanyRequest $request): object
    {
        try {
            $Company = $this->CompanyRepository->create($request->toArray());
            $old = $Company->getRawOriginal();
            $this->createLog($Company, $old, 'create');
            return $this->success_response(__('Success'), new CompanyResource($Company), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }

    /**
     * @param array $request
     * @param int  $id
     * @return object
     */
    public function update(CompanyRequest $request, $id)
    {
        try {
            $model = $this->CompanyRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }
            $old = $model->getRawOriginal();
            $Company = $this->CompanyRepository->update($model, $request->toArray());
            if ($request->has('roles'))
                $Company->roles()->sync($request->roles);

            $this->createLog($Company, $old, 'update');
            return $this->success_response(__('Success'), new CompanyResource($Company), null);
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
            $Company = $this->CompanyRepository->find($id);
            if (!$Company) {
                return $this->fail_response(__("Not Found"), 404);
            }
            return $this->success_response(__('Success'),  new CompanyResource($Company), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}