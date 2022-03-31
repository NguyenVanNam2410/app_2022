<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Send Error Response
     *
     * @param string $message
     * @param mix $errors
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendErrorResponse($message, $errors = null, $code = ResponseHelper::STATUS_CODE_BAD_REQUEST)
    {
        return ResponseHelper::sendSuccessResponse($code, $message, $errors);
    }

    /**
     * @param $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendSuccessResponse($data, $message = '', $code = ResponseHelper::STATUS_CODE_SUCCESS)
    {
    
        return ResponseHelper::sendSuccessResponse($code, $message, $data);
    }
}
