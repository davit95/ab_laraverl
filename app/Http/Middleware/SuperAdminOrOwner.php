<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class SuperAdminOrOwner
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $reqsuest
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->role->name == "client_user") {
            return redirect('/client');
        }
        if(auth()->user()->role->name == "admin") {
            return redirect('/csr');
        }
        if(auth()->user()->isSuperAdminOrOwner()) {
            return $next($request);
        } 
        return redirect('/centers');
    }
}
