<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\UnauthorizedException;
use Illuminate\Contracts\Auth\Guard;

class AllowIfAdmin
{
    protected $auth;

    public function __construct(Guard $auth) {

        $this->auth = $auth;

    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check() && $this->auth->user()->isAdmin()) {
            return $next($request);    
        }

        throw new UnauthorizedException;
        
    }
}
