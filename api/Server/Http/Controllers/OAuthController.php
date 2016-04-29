<?php

namespace Api\Server\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Exceptions\Custom\FailedTransactionException;
use Api\Server\Services\OAuthService;

class OAuthController extends Controller
{
    /**
     * Create a new home controller instance.
     *
     * @return void
     */
    public function __construct(OAuthService $oauthService)
    {        
        $this->oauthService = $oauthService;
    }

    public function postAuthorization(Request $request)
    {
        $response = $this->oauthService->authorize($request);
        return response()->json($response);
    }

    public function postRefreshToken(Request $request)
    {        
        $response = $this->oauthService->refreshToken($request);
        return response()->json($response);
    }

    public function postCheckAccessToken(Request $request)
    {
        $response = $this->oauthService->passOAuth($request);
        if(isset($response['expire'])){
            return response($response['expire'], 302);            
        }else if(isset($response['errors'])){
            return response($response['errors'], 511);
        }
        return response('success', 200);
    }
}