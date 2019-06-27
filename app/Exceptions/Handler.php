<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        if ($exception instanceof ModelNotFoundException) {
            return response(view('error', [
                'message' => 'Model Not Found',
                'code' => $exception->getStatusCode()
            ]), $exception->getStatusCode());
        }

        if ($exception instanceof HttpException) {
            if ($exception->getStatusCode() === 404 and $exception->getMessage() === '') {
                return response(view('error', [
                    'message' => 'Page Not Found',
                    'code' => $exception->getStatusCode()
                ]), $exception->getStatusCode());
            } else if ($exception->getStatusCode() === 405 and $exception->getMessage() === '') {
                return response(view('error', [
                    'message' => 'Method Not Allowed',
                    'code' => $exception->getStatusCode()
                ]), $exception->getStatusCode());
            }

            return response(view('error', [
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode()
            ]), $exception->getStatusCode());
        }

        return parent::render($request, $exception);
    }
}
