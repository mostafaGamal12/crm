<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelRequest;
use App\Http\Resources\ChannelResource;
use Illuminate\Http\Request;
use App\Repository\Interfaces\ChannelRepositoryInterface;
use App\Traits\LogTrait;

class ChannelController extends Controller
{
    use LogTrait;
    private $ChannelRepository;

    public function __construct(ChannelRepositoryInterface $ChannelRepository)
    {
        $this->ChannelRepository = $ChannelRepository;
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
            $Channels = $this->ChannelRepository->all($count, $paginate);

            return $this->success_response(__('Success'), json_decode(ChannelResource::collection($Channels)->response()->getContent()), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
    /**
     * @param UserRequest $request
     * @return object
     */
    public function store(ChannelRequest $request): object
    {
        try {
            $Channel = $this->ChannelRepository->create($request->toArray());
            $Channel->roles()->attach($request->roles);
            $Channel->companies()->attach($request->companies);
            $old = $Channel->getRawOriginal();
            $this->createLog($Channel, $old, 'create');
            return $this->success_response(__('Success'), new ChannelResource($Channel), null);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }

    /**
     * @param array $request
     * @param int  $id
     * @return object
     */
    public function update(ChannelRequest $request, $id)
    {
        try {
            $model = $this->ChannelRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }
            $old = $model->getRawOriginal();
            $Channel = $this->ChannelRepository->update($model, $request->toArray());
            if ($request->has('roles'))
                $Channel->roles()->sync($request->roles);
            if ($request->has('companies'))
                $Channel->companies()->sync($request->companies);

            $this->createLog($Channel, $old, 'update');
            return $this->success_response(__('Success'), new ChannelResource($Channel), null);
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
            $Channel = $this->ChannelRepository->find($id);
            if (!$Channel) {
                return $this->fail_response(__("Not Found"), 404);
            }
            return $this->success_response(__('Success'),  new ChannelResource($Channel), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}