<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\ReservationCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->user()->id)->with('user')->with('category')->get();
        $reservation_categories = ReservationCategory::all();

        return Inertia::render('Reservation/Index')->with([
            'reservations' => $reservations,
            'reservation_categories' => $reservation_categories,
        ]);
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'room_type' => $request->room_type,
            'reservation_date' => $request->reservation_date,
            'reservation_start_time' => $request->reservation_start_time,
            'reservation_end_time' => $request->reservation_end_time,
            'user_id'=>auth()->user()->id
        ]);
    }

    public function update(Request $request)
    {
        dd($request);
    }
}
