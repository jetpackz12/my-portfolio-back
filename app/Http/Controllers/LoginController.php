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
            return response()->json($data, 401);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            $data = [
                'message' => "Invalid password"
            ];
            return response()->json($data, 401);
        }

        $token = $user->createToken(
            'api-token',
            ['*'],
            now()->addDays(3)
        )->plainTextToken;

        $data = [
            'message' => "Login Success",
            'user' => $user,
            'token' => $token
        ];

        return response()->json($data);
    }
}
