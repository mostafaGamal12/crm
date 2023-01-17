<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function success_response($message = 'success', $items, $code = 200)
    {
        return response()->json([
            'status_code' => true,
            'code' => $code,
            'message' => $message,
            'items' => $items,

        ]);
    }
    function fail_response($message = 'fail', $code = 400)
    {
        return response()->json([
            'status_code' => false,
            'code' => $code,
            'message' => $message,
        ], $code);
    }
}