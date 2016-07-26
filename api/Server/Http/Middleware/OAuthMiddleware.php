<?php

namespace Api\Server\Http\Middleware;

use Closure;
use Api\Server\Services\OAuthService;
class OAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        $oauthService = new OAuthService();
        $response = $oauthService->passOauth($request);
        if(isset($response['expire'])){
            return response($response['expire'], 302);
        }else if(isset($response['errors'])){
            return response($response['errors'], 511);
        }
        return $next($request);
    }
}
