<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'email' | 'required' | 'unique:users,email'|'exists:users,email',
        //     'password' => 'required' | 'string'
        // ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = $request->user();
            $token = $user->createToken('my-app-token'.$user->name)->plainTextToken;
            return response()->json([
                'token' => $token,
                'data' => $user
            ], 200);
        }
        return response()->json(['message' => 'Incorrect credentails'], 401);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255|unique:users',
            'password'  => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('remember_token')->plainTextToken;
        return response()->json([
        'data' => $user,
        'access_token' => $token,
        'token_type' => 'Bearer' 
        ]);
    }

    public function logout(Request $request)
    {
        // $user = User::findOrFail($request);
        // $user->tokens()->delete();
        // return response()->json(['message' => 'Logged Out']);
      $request->user()->currentAccessToken()->delete();
      return response()->json(['message' => 'Logged Out']);
    }

    public function user(Request $request)
    {
        return response()->json([$request->user()]);
    }


}
