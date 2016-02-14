<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
    	switch($e) {
    		case ($e instanceof NotFoundHttpException):
    		case ($e instanceof ModelNotFoundException):
    			return response()->view('errors.404', [], 404);
    			break;
            case ($e instanceof UnauthorizedException):
                return response()->view('errors.unauthorized');
                break;
            case ($e instanceof NoActiveAccountException):
                return response()->view('errors.no-active-account');
                break;
            case ($e instanceof EmailNotProvidedException):
                return response()->view('errors.email-not-provided');
                break;
            case ($e instanceof EmailAlreadyInSystemException):
                return response()->view('errors.email-already-in-system');
                break;
            case ($e instanceof AlreadySyncedException):
                return response()->view('errors.already-synced');
                break;
            case ($e instanceof CredentialsDoNotMatchException):
                return response()->view('errors.credentials-do-not-match');
                break;
            case ($e instanceof ConnectionNotAcceptedException):
                return response()->view('errors.connection-not-accepted');
                break;
    		default:
    			return parent::render($request, $e);
    			break;
    	}        
    }
}
