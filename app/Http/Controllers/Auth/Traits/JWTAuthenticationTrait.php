<?php

namespace App\Http\Controllers\Auth\Traits;

use App\Data\Models\User;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Exceptions\InvalidCredentialsException;

trait JWTAuthenticationTrait
{
    /**
     * Login the user
     *
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        // Retrieve user based on the credentials provided
        $user = $this->authenticateUser($request);

        // Generate a token for the user and return it
        $token = app(JWTAuth::class)->fromUser($user);

        return ['token' => $token];
    }

    /**
     * Register a new user
     *
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
        // Validate the user's credentials
        $this->validateNewUser($request);

        // Create the new user
        $user = $this->create($request->all());

        return $user;
    }

    /**
     * Authenticate the user by their credentials
     *
     * @param Request $request
     * @return User
     */
    private function authenticateUser(Request $request)
    {
        //Validate request data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Check if a user with this credentials exist, throw error if not
        if (!\Auth::guard()->attempt($request->only('email', 'password'))) {
            throw new InvalidCredentialsException('Invalid email/password combination');
        }

        //Retrieve the user details and return
        return User::where('email', $request->email)->first();
    }
}