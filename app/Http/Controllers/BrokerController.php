<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrokerRequest;
use App\Http\Resources\BrokerResource;
use App\Models\Broker;
use App\Repository\Interfaces\BrokerRepositoryInterface;
use App\Traits\FileUploader;
use App\Traits\LogTrait;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    use LogTrait, FileUploader;
    private $BrokerRepository;

    public function __construct(BrokerRepositoryInterface $BrokerRepository)
    {
        $this->BrokerRepository = $BrokerRepository;
    }
    /**s
     * @param $count
     * @return Collection
     */
    public function index()
    {

        try {
            $paginate = Request()->paginate ?? true;
            $count = Request()->count ?? 20;
            $Brokers = $this->BrokerRepository->all($count, $paginate);

            return $this->success_response(__('Success'), json_decode(BrokerResource::collection($Brokers)->response()->getContent()), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"), 400);
        }
    }


    /**
     * @param BrokerRequest $request
     * @return object
     */
    public function store(BrokerRequest $request): object
    {
        try {
            $data = Request()->all();
            $Broker = $this->BrokerRepository->create($data);
            if ($request->has('files')) {
                foreach (Request()->file('files') as $file) {
                    $this->uploadImageFormData($file, 'media/Brokers', $Broker, Broker::File_TYPE_PDF);
                }
            }
            $Broker->roles()->attach($request->roles);
            $Broker->companies()->attach($request->companies);
            $old = $Broker->getRawOriginal();
            $this->createLog($Broker, $old, 'create');
            return $this->success_response(__('Success'), new BrokerResource($Broker), 200);
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
            $Broker = $this->BrokerRepository->find($id);
            if (!$Broker) {
                return $this->fail_response(__("Not Found"), 404);
            }
            return $this->success_response(__('Success'),  new BrokerResource($Broker), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }


    /**
     * @param BrokerRequest $request
     * @param int  $id
     * @return object
     */
    public function update(BrokerRequest $request, $id)
    {
        $data = Request()->all();
        // try {
        $model = $this->BrokerRepository->find($id);
        if (!$model) {
            return $this->fail_response(__("Not Found"));
        }

        $old = $model->getRawOriginal();
        $Broker = $this->BrokerRepository->update($model, $data);
        if ($request->has('roles'))
            $Broker->roles()->sync($request->roles);
        if ($request->has('companies'))
            $Broker->companies()->sync($request->companies);

        if ($request->has('projects')) {
            $Broker->projects()->detach();
            foreach ($request->projects as $project) {
                $Broker->projects()->attach($project['project_id'], ['commission' => $project['commission'] ?? 0]);
            }
        }
        $this->createLog($Broker, $old, 'update');
        return $this->success_response(__('Success'), new BrokerResource($Broker), null);
        // } catch (\Throwable $th) {
        //     return $this->fail_response(__("Some Thing Went Wrong"));
        // }
    }


    /**
     * @param int  $id
     * @return object
     */
    public function updateFiles($id)
    {
        Request()->validate([
            'files.*' => ['required',  "mimes:pdf", 'file', 'max:' . Broker::max_file_size],
        ]);

        $data = Request()->all();
        try {
            $model = $this->BrokerRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }

            if (Request()->has('files')) {
                foreach (Request()->file('files') as $file) {
                    $this->uploadImageFormData($file, 'media/Brokers', $model, Broker::File_TYPE_PDF);
                }
            }
            $old = $model->getRawOriginal();
            $Broker = $this->BrokerRepository->update($model, $data);
            $this->createLog($Broker, $old, 'update');
            return $this->success_response(__('Success'), new BrokerResource($Broker), 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}