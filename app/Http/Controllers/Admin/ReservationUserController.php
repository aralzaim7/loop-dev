<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateRespondReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use App\ViewModel\AdminReservationViewModel;
use App\ViewModel\ReservationUserViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationUserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('id', '<>', $request->user()->id)->whereHas('reservations')->paginate(5);

        $reservationUserViewModel = app(ReservationUserViewModel::class)->present($users);

        return Inertia::render('Admin/Users/Index')->with($reservationUserViewModel);
    }

}
