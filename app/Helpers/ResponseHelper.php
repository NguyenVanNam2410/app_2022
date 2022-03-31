<?php

namespace App\Helpers;

class ResponseHelper
{
    const STATUS_CODE_SUCCESS = 200;
    const STATUS_CODE_BAD_REQUEST = 400;
    const STATUS_CODE_UNAUTHORIZED = 401;
    const STATUS_CODE_FORBIDDEN = 403;
    const STATUS_CODE_NOTFOUND = 404;
    const STATUS_CODE_VALIDATE_ERROR = 422;
    const STATUS_CODE_SERVER_ERROR = 500;

    /**
     * @return string
     */
    public static function sendSuccessResponse($code, $message, $data = null)
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
