<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AccessTokensController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token =  $user->createToken($request->userAgent());

            return Response::json([
                'token' => $token->plainTextToken,
                'user' => $user
            ], 201);
        }
        return Response::json([
            'message' => 'no token baby'
        ], 401);
    }
}
