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
            return response()->json([
                'error' => 'Token not provided'
            ], 401);
        }

        try {
            $credentials = JWT::decode($token, config('jwt.key'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 'Token is expired'
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Token is invalid'
            ], 400);
        }

        $user = User::find($credentials->sub);
        $request->auth = $user;
        
        return $next($request);
    }
}
