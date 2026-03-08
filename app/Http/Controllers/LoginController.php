<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = [];

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            $data = [
                'message' => "Invalid email"
            ];
            return response()->json($data);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            $data = [
                'message' => "Invalid password"
            ];
            return response()->json($data);
        }

        $token = $user->createToken('api-token');
        $token->accessToken->expires_at = now()->addDay(2);
        $token->accessToken->save();

        $data = [
            'message' => "Login Success",
            'user' => $user,
            'token' => $token->plainTextToken
        ];

        return response()->json($data);
    }
}
