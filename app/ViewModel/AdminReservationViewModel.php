<?php


namespace App\ViewModel;


use App\Models\Reservation;
use App\Models\ReservationCategory;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminReservationViewModel
{

    public function present($request): array
    {

        $status=$request->status;

        $query = Reservation::query()->orderBy('reservation_date', 'asc');

        if($status) {
            $query->where('status', $status);
        }

        $allReservations = $query->paginate(5);

        $allReservations->load(['user', 'category']);
        return [
            'status' => $status,
            'reservations' => $this->formatReservation($allReservations),
        ];
    }

    private function formatReservation(LengthAwarePaginator $allReservations): LengthAwarePaginator
    {
        $allReservationCollection = $allReservations->getCollection()
            ->map(function ($reservation) {

            $reservation_date = $reservation->reservation_date->format('Y-m-d');
            $reservation_start_time = Carbon::parse($reservation->reservation_start_time)->format('H:i');
            $reservation_end_time = Carbon::parse($reservation->reservation_end_time)->format('H:i');

            return [
                'id' => $reservation->id,
                'username' => $reservation->user->full_name,
                'user_info' => "<span> {$reservation->user->full_name} <br/> {$reservation->user->email} <br/> {$reservation->user->phone}</span>",
                'category_name' => $reservation->category->name,
                'title' => $reservation->title,
                'room_type' => $reservation->room_type,
                'status' => $reservation->status,
                'readable_creation_date' => $reservation->created_at->diffForHumans(),
                'readable_reservation_time' => "<span> {$reservation_date} <br/> {$reservation_start_time} - {$reservation_end_time}</span>",
                'category' => $reservation->category,
            ];
        });

        return ($allReservations->setCollection($allReservationCollection));
    }
}

