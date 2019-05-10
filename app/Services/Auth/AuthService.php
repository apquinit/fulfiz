<?php

namespace App\Services\Auth;

use Firebase\JWT\JWT;
use Carbon\Carbon;

class AuthService
{
    /**
     * Encode a new token.
     *
     * @param  $userId
     * @return string
     */
    public function jwtEncodeToken(int $userId)
    {
        $payload = [
            'iss' => env('APP_NAME'),
            'sub' => $userId,
            'iat' => time(),
            'exp' => time() + config('jwt.lifetime') * 60,
        ];

        return JWT::encode($payload, config('jwt.key'));
    }

    /**
     * Decode token.
     *
     * @param  $token
     * @return string
     */
    protected function jwtDecodeToken(string $token)
    {
        return JWT::decode($token, config('jwt.key'), ['HS256']);
    }

    /**
     * Decode token expiration.
     *
     * @param  $token
     * @return string
     */
    private function decodeTokenExpiration(string $token)
    {
        return Carbon::createFromTimestamp($this->jwtDecodeToken($token)->exp, config('app.timezone'))->toDateTimeString();
    }

    /**
     * Decode token subject.
     *
     * @param  $token
     * @return string
     */
    public function decodeTokenSubject(string $token)
    {
        return $this->jwtDecodeToken($token)->sub;
    }

    /**
     * Generate token.
     *
     * @param  $userId
     * @return mixed
     */
    public function generateToken(int $userId)
    {
        $token = $this->jwtEncodeToken($userId);
        $expires_at = $this->decodeTokenExpiration($token);

        return $response = [
            'token' => $token,
            'expires_at' => $expires_at,
        ];
    }
}
