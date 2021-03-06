<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    // public function register()
    // {
    //     $this->reportable(function (Throwable $e) {
    //         //
    //     });
    //     $this->renderable(function (ValidationException $e, $request) {
    //         return response()->json([
    //             'status_code' => 422,
    //             'message' => 'There is an error, please check your input data.',
    //             'data' => $e->errors()
    //         ]);
    //     });
    // }
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (InputException $e, $request) {
            return response()->json([
                'status_code' => ResponseHelper::STATUS_CODE_BAD_REQUEST,
                'message' => $e->getMessage(),
            ]);
        });
    }
    protected function invalidJson($request, ValidationException $exception)
    {
        return ResponseHelper::sendResponse($exception->status, trans('response.invalid'), $exception->errors());
    }
}
