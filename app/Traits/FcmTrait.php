<?php

namespace App\Traits;

use App\Services\FcmService;

trait FcmTrait
{
    private $fcm_service;
    public function __construct(FcmService $fcm_service)
    {
        $this->fcm_service = $fcm_service;
    }
    public function notifyUser($data)
    {

        // $user = User::where('id', $request->id)->first();

        $notification_id = $user->notification_id;
        $title = "Greeting Notification";
        $message = "Have good day!";
        // $id = $user->id;
        $type = "basic";

        $res =  $this->fcm_service->send_notification_FCM($notification_id, $title, $message, $id, $type);

        if ($res == 1) {

            // success code

        } else {

            // fail code
        }
    }
}