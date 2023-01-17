<?php


namespace App\Traits;

use App\Models\Log;
use App\Repository\Interfaces\LogRepositoryInterface;
use App\Repository\LogRepository;
use Auth;
use Carbon\Carbon;

trait LogTrait
{

    public function addLog($model_make_action_id, $model_make_action, $email = null, $model_take_action = null, $model_take_action_id = null, $action, $message)
    {
        $logRepository = new LogRepository(new Log);
        $data = [
            "model_id" => $model_make_action_id,
            "model" => class_basename($model_make_action),
            "email" => $email,
            "model_take_action_name" => class_basename($model_take_action),
            "model_take_action_id" => $model_take_action_id,
            "action" => $action,
            "message" => $message,
        ];
        $log = $logRepository->create($data);
        if ($log) {
            return true;
        }
        return false;
    }

    public function createLog($model, $old_model = null, $action = '', $message = '')
    {
        if ($action == 'create' || $action == 'delete') {
            $this->addLog(
                Auth::id(),
                Auth::user(),
                Auth::user()->email,
                $model,
                $model->id,
                $action,
                $message . $model
            );
        } else {
            $message = '';
            if (count($model->getChanges()) > 0) {
                foreach ($model->getChanges() as $key => $value) {
                    $message .= ' update ' . class_basename($model) . ' ' . $key . ' from ' . $old_model[$key]
                        . ' to ' . $value;
                }
                $this->addLog(
                    Auth::id(),
                    Auth::user(),
                    Auth::user()->email,
                    $model,
                    $model->id,
                    $action,
                    $message
                );
            }
        }
    }
}