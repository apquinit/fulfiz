<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof HttpException) {
            if ($exception->getStatusCode() === 404 and $exception->getMessage() === '') {
                return response(view('error', [
                    'message' => 'Page not found.',
                    'code' => 404
                ]), 404);
            } else {
                return response(['errors' => [
                    'code' => $exception->getStatusCode(),
                    'message' => $exception->getMessage(),
                ]], $exception->getStatusCode())->header('Content-Type', 'application/json;charset=UTF-8');
            }
        } else if ($exception instanceof ModelNotFoundException) {
            return response(['errors' => [
                'code' => 404,
                'message' => 'Record not found.',
                ]
            ], 404)->header('Content-Type', 'application/json;charset=UTF-8');
        }

        return parent::render($request, $exception);
    }
}
