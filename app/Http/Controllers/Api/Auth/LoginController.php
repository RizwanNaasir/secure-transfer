<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|min:6'
        ]);
        try {
            auth()->attempt($credentials);
            if (auth()->check()) {
                return $this->success([
                    'token' => auth()->user()->createToken('API Token')->plainTextToken,
                ]);
            } else {
                return $this->error(
                    message: 'invalid credentials',
                    code: 401
                );
            }

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->update();
            return $this->success(message: 'user updated successfully');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }

    public function logout(): array
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
