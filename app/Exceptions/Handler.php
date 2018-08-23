<?php

namespace App\Exceptions;

use App;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        if(App::isDownForMaintenance()) {
            return responder()->error('maintenance', __('api.503.maintenance'))->respond(503);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return responder()->error('endpoint_non_existent', 'The endpoint does not exist.')->respond(404);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return responder()->error('validation_error', collect($exception->validator->getMessageBag())->first()[0])->data([
                'wrong_fields' => $exception->validator->getMessageBag(),
                'fields' => $request->except(['password', 'password_confirmation']),
            ])->respond(400);
        }

        if(
            $exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException
            ||
            $exception instanceof \Illuminate\Auth\Access\AuthorizationException
        ) {
            return responder()->error('not_enough_permissions', __('api.401.permissions'))->respond(401);
        }

        if ($exception instanceof \Illuminate\Database\QueryException) {
            if(App::environment('production')) {
                return responder()->error('sql_exception', 'Există o problemă serioasă! Contactează-ne!')->respond(500);
            }
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return responder()->error('wrong_token', 'Nu ești autentificat!')->respond(401);
    }
}
