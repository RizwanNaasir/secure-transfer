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
        if (!User::whereEmail($credentials['email'])->first()->hasVerifiedEmail()){
            return $this->error(
                message: 'Please verify your email address!',code: 421);
        }
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

    public function update(Request $request)
    {
        $user = User::whereId($request->user()->id)->first();
        if (filled($request->input('name'))) {
            $user->name = $request->input('name');
        }
        if (filled($request->input('surname'))) {
            $user->surname = $request->input('surname');
        }
        if (filled($request->input('email'))) {
            $user->email = $request->input('email');
        }
        if (filled($request->input('password'))) {
            $user->password = bcrypt($request->input('password'));
        }
        if (filled($request->input('phone'))) {
            $user->phone = $request->input('phone');
        }
        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('public');
        }
        if ($request->hasFile('document1')) {
            $user->document1 = $request->file('document1')->store('public');
        }
        if ($request->hasFile('document2')) {
            $user->document2 = $request->file('document2')->store('public');
        }
        $user->save();

        return $this->success(['profile' => $user], message: 'Profile updated successfully');
        }

    public function logout(): array
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
