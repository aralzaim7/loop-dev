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
            ->orderBy('reservation_date', 'asc')
            ->paginate(5);
        $reservationViewModel = app(ReservationViewModel::class)->present($reservations);

        return Inertia::render('Guest/Reservation/Index')->with($reservationViewModel);
    }

    public function store(StoreReservationRequest $request)
    {
        $selectedTimeSlots = $request->selected_time_slots;

        $startTimes = collect();
        $endTimes = collect();

        foreach ($selectedTimeSlots as $timeSlot) {
            $separatedTimeSlots = explode(' - ', $timeSlot);

            $startTimes->push($separatedTimeSlots[0]);
            $endTimes->push($separatedTimeSlots[1]);
        }

        $reservationStartTime = $startTimes->sort()->first();
        $reservationEndTime = $endTimes->sortDesc()->first();

        $request->user()
            ->reservations()
            ->create(
                array_merge($request->validated(),
                    [
                        'reservation_start_time' => $reservationStartTime,
                        'reservation_end_time' => $reservationEndTime
                    ]
                )
            );

        return redirect('/my-reservations')->with('success', 'Reservation created successfully.');
    }

    public function update(StoreReservationRequest $request, Reservation $reservation)
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