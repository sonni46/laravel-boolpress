<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckApiToken
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
        // recupero l'autorizzazione token dalla request
        $auth_token = $request->header('authorization');

        // verificare se è presente il token 
        if(empty($auth_token)) {
            return response()->json([
                'success' => false,
                'error' =>  'Api token non trovato'
            ]);
        }

        // estrare l'api token di autorizzazione che è formato in questo modo: Bearer
        $api_token = substr($auth_token,7);

        // verifico la corretezza del'api token 
        $user_api_token = User::where('api_token',$api_token)->first();
        if(!$user_api_token){
            return response()->json([
                'success' => false,
                'error' =>  'Api token errato'
            ]);
        }

        return $next($request);
    }
}
