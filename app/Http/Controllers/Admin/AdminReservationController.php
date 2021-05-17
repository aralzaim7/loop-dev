<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateRespondReservationRequest;
use App\Models\Reservation;
use App\ViewModel\AdminReservationViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        $status=$request->status;

        $query = Reservation::orderBy('reservation_date', 'asc');

        if($status) {
            $query->where('status', $status);
        }

        $reservations = $query->paginate(5);

        $reservations->load(['user', 'category']);

        $adminReservationViewModel = app(AdminReservationViewModel::class)->present($reservations);

        return Inertia::render('Admin/Reservation/Index')->with($adminReservationViewModel);
    }

    public function update(UpdateRespondReservationRequest $request,  Reservation $reservation)
    {
        $reservation->update($request->validated());
        return redirect('/admin/reservations')->with('success', 'Reservation status updated successfully.');
    }

}
