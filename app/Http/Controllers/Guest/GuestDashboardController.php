<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GuestDashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Guest/Dashboard')->with([
            //'user' => $user,
        ]);
    }
}
