<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', Password::defaults()],
            ]);
        } catch (\Exception $e) {
            return $this->error(
                message: $e->getMessage(),
                code: 400
            );
        }

        User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        auth()->attempt($request->only('email', 'password'));

        return $this->success(
            data: ['token' => auth()->user()->createToken('API Token')->plainTextToken],
            message: 'User created successfully'
        );
    }
}
