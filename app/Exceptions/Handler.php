<?php

namespace App\Exceptions;

use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
        'secret'
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $e)
    {
        if ($this->shouldReport($e) && app()->bound('sentry')) {
            app('sentry')->captureException($e);
        }
        return parent::report($e);
    }

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson() || $request->isJson()) {
            if ($e instanceof QueryException || $e instanceof RelationNotFoundException) {
                return response()->json([
                    'error' => [
                        'message' => 'An error occurred, please try again later.',
                        'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                    ]
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'error' => [
                        'message' => 'Missing parameters or resource not found.',
                        'code' => Response::HTTP_NOT_FOUND
                    ]
                ], Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => Response::HTTP_NOT_FOUND
                    ]
                ], Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof AuthorizationException) {
                return response()->json([
                    'error' => [
                        'message' => 'You Do Not Have Permission to carry out this action',
                        'code' => Response::HTTP_FORBIDDEN,
                    ]
                ], Response::HTTP_FORBIDDEN);
            }

            if ($e instanceof HttpResponseException) {
                return response()->json([
                    'error' => [
                        'message' => $e->getResponse()->getContent(),
                        'code' => $e->getResponse()->getStatusCode()
                    ]
                ], Response::HTTP_BAD_REQUEST);
            }

            if ($e instanceof HttpException) {
                return response()->json([
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getStatusCode()
                    ]
                ], $e->getStatusCode());
            }

            if ($e instanceof InvalidEnumMemberException) {
                return response()->json([
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    ]
                ], Response::HTTP_BAD_REQUEST);
            }

            if ($e instanceof ValidationException) {
                return response()->json([
                    'error' => [
                        'message' => $e->validator->errors()->first(),
                        'errors' => $e->errors()
                    ]
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
        return parent::render($request, $e);
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson() || $request->isJson()) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage(),
                    'code' => Response::HTTP_UNAUTHORIZED
                ]
            ], Response::HTTP_UNAUTHORIZED);
        }
        return parent::unauthenticated($request, $exception);
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'error' => [
                'message' => $exception->getMessage(),
                'code' => $exception->status,
                'errors' => $exception->errors()
            ]
        ], $exception->status);
    }
}
