<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Http\Resources\SettingResource;
use Illuminate\Http\Request;
use App\Repository\Interfaces\SettingRepositoryInterface;
use App\Traits\LogTrait;

class SettingController extends Controller
{
    use LogTrait;
    private $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
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
            $settings = $this->settingRepository->all($count, $paginate);

            return $this->success_response(__('Success'), json_decode(SettingResource::collection($settings)->response()->getContent()), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }


    /**
     * @param array $request
     * @param int  $id
     * @return object
     */
    public function update(SettingRequest $request, $id)
    {
        try {
            $model = $this->settingRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }
            $old = $model->getRawOriginal();
            $setting = $this->settingRepository->update($model, $request->toArray());
            $this->createLog($setting, $old, 'update');
            return $this->success_response(__('Success'),  $setting, null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}