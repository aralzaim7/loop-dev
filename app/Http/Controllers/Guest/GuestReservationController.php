<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\ViewModel\ReservationViewModel;
use Inertia\Inertia;
use Inertia\Response;

class GuestReservationController extends Controller
{
    public function index(): Response
    {
        $reservations = auth()->user()->reservations()
            ->with('roomType')
            ->orderBy('reservation_date','asc')
            ->paginate(5);
        $reservationViewModel= app(ReservationViewModel::class)->present($reservations);

        return Inertia::render('Guest/Reservation/Index')->with($reservationViewModel);
    }

    public function store(StoreReservationRequest $request)
    {
        $request->user()
            ->reservations()
            ->create($request->validated());

        return redirect('/my-reservations')->with('success', 'Reservation created successfully.');
    }

    public function update(StoreReservationRequest $request,  Reservation $reservation)
    {
        $reservation->update($request->validated());
        return redirect('/my-reservations')->with('success', 'Reservation editted successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        //soft delete
        $reservation->delete();

        return redirect('/my-reservations')->with('success', 'Reservation deleted successfully.');
    }

}