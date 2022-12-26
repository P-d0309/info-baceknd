<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequset;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login(LoginRequset $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return Response::json([
                'status' => 'error',
                'code' => 422,
                "messages" =>  [
                    "email" =>  [
                        "credentials can not able to verify. Please try again with valid one"
                    ]
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth')->plainTextToken;
        request()->merge(['token' => $token, 'id' => $user->id]);

        return new UserResource($user);
    }
}
