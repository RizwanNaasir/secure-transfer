<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function profile()
    {
        return view(view: 'user.profile.index');
    }
}
