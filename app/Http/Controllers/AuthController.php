<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Auth service instance.
     *
     * @var App\ServicesService
     */
    private $authService;

    /**
     * User service instance.
     *
     * @var App\ServicesService
     */
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request, AuthService $authService, UserService $userService)
    {
        $this->request = $request;
        $this->authService = $authService;
        $this->userService = $userService;
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
            abort(404, 'User Not Found');
        }
        
        // Get user from database.
        $user = $this->userService->getUserByUsername($this->request->input('username'));

        // Verify if user exists.
        if (!$user) {
            abort(404, 'User Not Found');
        }

        // Verify the password and generate the token.
        if (Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->authService->generateToken($user->id)
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
            'payload' => $this->authService->decodeTokenPayload($this->request->bearerToken())
        ], 200);
    }
}
