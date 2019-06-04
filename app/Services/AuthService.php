<?php

namespace App\Services;

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
    private function jwtDecodeToken(string $token)
    {
        return JWT::decode($token, config('jwt.key'), ['HS256']);
    }

    /**
     * Decode token payload.
     *
     * @param  $token
     * @return string
     */
    public function decodeTokenPayload(string $token)
    {
        return $this->jwtDecodeToken($token);
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

        return $token;
    }
}
