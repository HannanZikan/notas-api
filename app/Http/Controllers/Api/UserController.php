<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
                                 'name'     => $data['name'],
                                 'email'    => $data['email'],
                                 'password' => Hash::make($data['password']),
                             ]);

        return new UserResource($user);
    }
}
