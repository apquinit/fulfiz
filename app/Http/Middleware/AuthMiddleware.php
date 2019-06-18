<?php

namespace App\Http\Middleware;

use Log;
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
            Log::alert('Unauthorized request.', ['username' => $request->input('username')]);
            abort(401, 'Unauthorized');
        }

        try {
            $credentials = JWT::decode($token, config('jwt.key'), ['HS256']);
        } catch (ExpiredException $e) {
            Log::alert('User provided token is expired.', ['username' => $request->input('username')]);
            abort(400, 'Token Expired');
        } catch (Exception $e) {
            Log::alert('User provided token is invalid.', ['username' => $request->input('username')]);
            abort(400, 'Token Invalid');
        }

        $user = User::find($credentials->sub);
        $request->auth = $user;
        
        return $next($request);
    }
}
