<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =   $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'user_name' => 'required|string|unique:users,user_name',
            'phone_number' => 'required|string|unique:users,phone_number',
            'birth_date' => 'required|date',
            'address' => 'required|string',
            'image' => 'nullable|string',
            'type' => 'required|in:user,owner,admin',
        ]);
        $user = User::create($data);
        $token =  $user->createToken($request->userAgent());

        return Response::json([
            'token' => $token->plainTextToken,
            'user' => $user
        ], 201);

        return Response::json([
            'message' => 'no token baby'
        ], 401);
    }
    public function login(Request $request)
    {
        $data =   $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token =  $user->createToken($request->userAgent());
            return Response::json([
                'token' => $token->plainTextToken,
                'message' => 'login done',
                'user' => $user
            ], 201);
        }
        return Response::json([
            'message' => 'no token baby'
        ], 401);
    }

    public function logout($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        if (null === $token) {
            $user->currentAccessToken()->delete;
            return response()->json(['message' => '1Successfully logged out']);
        }

        $pat =    PersonalAccessToken::findToken($token);
        if ($user->id == $pat->tokenable_id) {
            $pat->delete();
            // response()->json(['message' => '2Successfully logged out']);
        }
        // if ($user) {
        //     $user->tokens()->revoke();
        //     return response()->json(['message' => 'Successfully logged out']);
        // }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
    // return Response::json([$project, 200, "created"]);
    // return $user;


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
