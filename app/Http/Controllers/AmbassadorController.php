<?php

namespace App\Http\Controllers;

use App\Http\Requests\AmbassadorRequest;
use App\Http\Resources\AmbassadorResource;
use App\Repository\Interfaces\AmbassadorRepositoryInterface;
use App\Traits\LogTrait;
use Illuminate\Http\Request;

class AmbassadorController extends Controller
{
    use LogTrait;
    private $AmbassadorRepository;

    public function __construct(AmbassadorRepositoryInterface $AmbassadorRepository)
    {
        $this->AmbassadorRepository = $AmbassadorRepository;
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
            $ambassadors = $this->AmbassadorRepository->all($count, $paginate);

            return $this->success_response(__('Success'), json_decode(AmbassadorResource::collection($ambassadors)->response()->getContent()), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"), 400);
        }
    }


    /**
     * @param UserRequest $request
     * @return object
     */
    public function store(AmbassadorRequest $request): object
    {
        try {
            $data = Request()->all();
            if (isset(Request()->id_photo)) {
                $data['id_photo'] = UplaodPhoto(Request()->id_photo, 'Ambassador');
            }
            $ambassador = $this->AmbassadorRepository->create($data);
            $ambassador->roles()->attach($request->roles);
            $ambassador->companies()->attach($request->companies);
            $old = $ambassador->getRawOriginal();
            $this->createLog($ambassador, $old, 'create');
            return $this->success_response(__('Success'), new AmbassadorResource($ambassador), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"), 400);
        }
    }
    /**
     * @param int $id
     * @return object
     */
    public function show($id): object
    {
        try {
            $ambassador = $this->AmbassadorRepository->find($id);
            if (!$ambassador) {
                return $this->fail_response(__("Not Found"), 404);
            }
            return $this->success_response(__('Success'),  new AmbassadorResource($ambassador), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }


    /**
     * @param AmbassadorRequest $request
     * @param int  $id
     * @return object
     */
    public function update(AmbassadorRequest $request, $id)
    {
        $data = Request()->all();
        try {
            $model = $this->AmbassadorRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }

            $old = $model->getRawOriginal();
            $ambassador = $this->AmbassadorRepository->update($model, $data);
            if ($request->has('roles'))
                $ambassador->roles()->sync($request->roles);
            if ($request->has('companies'))
                $ambassador->companies()->sync($request->companies);

            $this->createLog($ambassador, $old, 'update');
            return $this->success_response(__('Success'), new AmbassadorResource($ambassador), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }


    /**
     * @param int  $id
     * @return object
     */
    public function updateIdPhoto($id)
    {
        Request()->validate([
            'id_photo' =>  ['required',  "mimes:jpeg,bmp,png,jpg", 'image', 'file'],
        ]);

        $data = Request()->all();
        try {
            $model = $this->AmbassadorRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }

            if (isset(Request()->id_photo)) {
                $data['id_photo'] = UplaodPhoto(Request()->id_photo, 'Ambassador');
            } else {
                $data['id_photo'] = $model->profile_photo;
            }
            $old = $model->getRawOriginal();
            $ambassador = $this->AmbassadorRepository->update($model, $data);
            $this->createLog($ambassador, $old, 'update');
            return $this->success_response(__('Success'),  $ambassador, 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}