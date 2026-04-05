<?php

namespace App\Http\Controllers\Api\V1\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        if(!Auth::attempt($data)){
            return response()->json(['message' => 'Invalid Credentials'], 403);
        }
        
        return response()->json([
            'message' => 'Login Successfull',
            'token' => $request->user()->createToken('user')->plainTextToken
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'message' => 'Logged out successfull'
        ]);
    }
}
