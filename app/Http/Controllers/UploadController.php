<?php

namespace App\Http\Controllers;

class UploadController extends Controller
{
    public function store()
    {
        return request()->file('avatar')->store('public');
    }
    public function load()
    {
        return 'weerwre';
    }
}