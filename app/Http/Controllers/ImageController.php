<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\ImageRepositoryInterface;
use App\Traits\LogTrait;

class ImageController extends Controller
{
    use LogTrait;
    private $ImageRepository;

    public function __construct(ImageRepositoryInterface $ImageRepository)
    {
        $this->ImageRepository = $ImageRepository;
    }



    public function delete($id)
    {
        try {
            $model = $this->ImageRepository->find($id);
            if (!$model) {
                return $this->fail_response(__("Not Found"));
            }
            $old = $model->getRawOriginal();
            $this->ImageRepository->delete($id);
            $this->createLog($model, $old, 'delete');
            return $this->success_response(__('Success'), $model, 200);
        } catch (\Throwable $th) {
            return $this->fail_response(__("Some Thing Went Wrong"));
        }
    }
}