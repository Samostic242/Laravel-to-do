<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Interfaces\AuthInterface;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    function __construct(
        protected AuthInterface $authInterface
    ){}

    /**
     * Register the user
     */
    public function register(RegistrationRequest $request)
    {
        $validated_data = $request->validated();
        $user = $this->authInterface->register($validated_data);
        return SuccessResponse('User Registered Successfully', $user);
    }

    public function login(LoginRequest $request)
    {
        $validated_data = $request->validated();
        $login = $this->authInterface->login($validated_data);
        if (!$login['status']) {
            return ErrorResponse($login['code'], $login['message']);
        }
        return SuccessResponse($login['message'], $login['data']);
    }
}
