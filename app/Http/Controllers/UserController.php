<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Profile/Index')->with([
            'user' => auth()->user(),
        ]);
    }
}
