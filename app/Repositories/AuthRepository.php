<?php

namespace App\Repositories;

use App\Http\Resources\Auth\UserResource;
use App\Interfaces\AuthInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{
    /**
     * Summary of register
     * @param array $data
     * @return User
     */
    public function register(array $data){
        $user = new User();
        $user->name = $data['name'] ?? null;
        $user->email = $data['email'] ?? null;
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;
    }

    public function login(array $data){
        try{
        if (!$token = auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return [
                'status' => false,
                'message' => 'Incorrect username or password',
                'code' => 401,
                'data' => null
            ];
        }
        return [
            'status' => true,
            'message' => 'User Logged in successfully',
            'code' => 200,
            'data' => [
                'token' => $token,
                'user' => new UserResource(auth()->user())
            ]
        ];
    } catch (Exception $exception) {
        return [
            'status' => false,
            'message' => $exception->getMessage(),
            'code' => 400,
            'data' => null
        ];
    }
    }
}
