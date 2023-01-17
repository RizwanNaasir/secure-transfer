<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Auth\Register;
use App\Http\Requests\RegisterApiRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __invoke(RegisterApiRequest $request): JsonResponse
    {
        info('req',$request->all());

        User::query()->create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
        ]);

        auth()->attempt($request->only('email', 'password'));

        auth()->user()->sendEmailVerificationNotification();

        return $this->success(
//            data: ['token' => auth()->user()->createToken('API Token')->plainTextToken],
            message: 'User created successfully'
        );
    }
}
