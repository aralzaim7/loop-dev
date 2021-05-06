<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $userObject = auth()->user();
        $user = [
            'first_name' => $userObject->first_name,
            'last_name' => $userObject->last_name,
            'email' => $userObject->email,
            'phone' => $userObject->phone,
            'address' => $userObject->address,
            'city' => $userObject->city,
            'country' => $userObject->country,
        ];

        return Inertia::render('Profile/Index')->with([
            'user' => $user,
        ]);
    }
}
