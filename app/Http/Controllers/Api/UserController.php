<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function store(UserRequest $request)
    {
        $data = $request->validate;

        // Criar um novo usuário
        $user = User::create([
                                 'name'     => $data->name,
                                 'email'    => $data->email,
                                 'password' => Hash::make($data->password),
                             ]);

        // Responder com o novo usuário criado
        return response()->json(['user' => $user], 200);
    }
}
