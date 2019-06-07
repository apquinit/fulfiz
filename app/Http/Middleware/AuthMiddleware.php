<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            abort(401, 'Unauthorized');
        }

        try {
            $credentials = JWT::decode($token, config('jwt.key'), ['HS256']);
        } catch (ExpiredException $e) {
            abort(400, 'Token Expired');
        } catch (Exception $e) {
            abort(400, 'Token Invalid');
        }

        $user = User::find($credentials->sub);
        $request->auth = $user;
        
        return $next($request);
    }
}
