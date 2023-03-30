<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json(
            [
                'status' => 'Request was successful',
                'message' => $message,
                'data' => $data
            ],
            $code
        );
    }

    protected function error($message, $code = 400)
    {
        return response()->json(
            [
                'status' => 'Error has occurred',
                'message' => $message,
                'data' => null
            ],
            $code
        );
    }
}
