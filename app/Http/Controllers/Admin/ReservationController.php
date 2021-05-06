<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return Inertia::render('Reservation/Index')->with([
            'reservations' => $reservations,
        ]);
    }

    public function store(Request $request)
    {
        $reservation = Reservation::create([
            'title' => $request->title,
            'category' => $request->category,
            'room_type' => $request->room_type,
            'reservation_date' => $request->reservation_date,
            'reservation_start_time' => $request->reservation_start_time,
            'reservation_end_time' => $request->reservation_end_time,
            'user_id'=>auth()->user()->id
        ]);


        $user->save();
    }
}
