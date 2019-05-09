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
     * @var App\Services\AuthService
     */
    private $authService;

    /**
     * User service instance.
     *
     * @var App\Services\UserService
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
        $this->validate($this->request, [
            'username' => 'required|string',
            'password' => 'required'
        ]);

        // Get user from database.
        $user = $this->userService->getUserByUsername($this->request->input('username'));

        // Verify if user exists.
        if (!$user) {
            return response()->json([
                'error' => 'User does not exist.'
            ], 400);
        }

        // Verify the password and generate the token.
        if (Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'auth' => $this->authService->generateToken($user->id)
            ], 200);
        }

        // Bad Request response.
        return response()->json([
            'error' => 'Username or password is invalid.'
        ], 400);
    }

    /**
     * Get token subject.
     *
     * @param  string $token
     * @return int
     */
    public function getTokenSubject()
    {
        return response()->json([
            'user_id' => $this->authService->decodeTokenSubject($this->request->bearerToken())
        ], 200);
    }
}
