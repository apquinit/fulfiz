<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Carbon\Carbon;

class AuthController
{
    /**
     * Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function getToken(User $user)
    {
        // Validate user.
        if (empty($this->request->input('username')) or empty($this->request->input('password'))) {
            abort(422, 'Unprocessable Entity');
        }

        // Get user from database.
        $user = User::where('username', $this->request->input('username'))->first();

        // Verify if user exists.
        if (!$user) {
            abort(404, 'User Not Found');
        }

        // Verify the password and generate the token.
        if (Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->generateToken($user->id)
            ], 200);
        }

        // Thrown when password is invalid.
        abort(404, 'User Not Found');
    }

    /**
     * Get token payload.
     *
     * @param  string $token
     * @return int
     */
    public function getTokenPayload()
    {
        return response()->json([
            'payload' => $this->decodeTokenPayload($this->request->bearerToken())
        ], 200);
    }

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
    private function decodeTokenPayload(string $token)
    {
        return $this->jwtDecodeToken($token);
    }

    /**
     * Generate token.
     *
     * @param  $userId
     * @return mixed
     */
    private function generateToken(int $userId)
    {
        $token = $this->jwtEncodeToken($userId);

        return $token;
    }
}
