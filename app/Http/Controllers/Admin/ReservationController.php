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
        $reservations = auth()->user()->reservations()->paginate(2);
        $reservations->load(['user', 'category']);


        $reservation_categories = ReservationCategory::all();

        return Inertia::render('Reservation/Index')->with([
            'reservations' => $reservations,
            'reservation_categories' => $reservation_categories,
        ]);
    }

    public function store(StoreReservationRequest $request)
    {
        auth()->user()
            ->reservations()
            ->create($request->validated());
    }

    public function update(Request $request)
    {
        dd($request);
    }
}
