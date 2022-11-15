<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            return $this->success(data: User::query()->where('id',request()->user()->id)->first());
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
}
