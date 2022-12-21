<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __invoke(Request $request)
    {
        $rated = $request->user()->review(
            modelTobeReviewed: User::find($request->input('user_id')),
            reviewer: $request->user(),
            stars: $request->integer('stars'),
            review: $request->input('review')
        );
        if ($rated or gettype($rated) === 'integer') {
            return $this->success(message: 'User successfully rated!');
        }
    }
}