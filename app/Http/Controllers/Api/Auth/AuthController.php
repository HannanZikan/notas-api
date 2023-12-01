<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                                        'message' => 'Authorized',
                                        'token'   => $request->user()->createToken('Auth')->plainTextToken,
                                    ], 200);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
                                    'message' => 'Até logo!',
                                ], 200);
    }
}
