<?php


namespace App\ViewModel;


use App\Models\OpeningHour;
use App\Models\ReservationCategory;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ReservationViewModel
{

    public function present(LengthAwarePaginator $reservations): array
    {
        return [
            'reservations' => $this->formatReservation($reservations),
            'reservationCategories' => ReservationCategory::all(),
            'reservationRoomTypes'=>RoomType::all(),
//            'reservationHours' => $this->getAvailableReservationHours()
        ];
    }

    private function getAvailableReservationHours()
    {
        $day = strtolower(Carbon::today()->englishDayOfWeek);
        $openingHours = OpeningHour::query()
            ->with('roomType')
            ->where('day', '=', $day)
            ->get();

    }

    private function formatReservation(LengthAwarePaginator $reservations)
    {
        $reservationCollection = $reservations->getCollection()
            ->map(function ($reservation) {

                $reservation_date = $reservation->reservation_date->format('Y-m-d');
                $reservation_start_time = Carbon::parse($reservation->reservation_start_time)->format('H:i');
                $reservation_end_time = Carbon::parse($reservation->reservation_end_time)->format('H:i');

                return [
                    'id' => $reservation->id,
                    'category_id' => $reservation->category_id,
                    'title' => $reservation->title,
                    'room_type_id' => $reservation->roomType->id,
                    'room_type_name' => $reservation->roomType->name,
                    'reservation_date' => $reservation_date,
                    'reservation_start_time' => $reservation_start_time,
                    'reservation_end_time' => $reservation_end_time,
                    'status' => $reservation->status,
                    'readable_creation_date' => $reservation->created_at->diffForHumans(),
                    'readable_reservation_time' => "<span> {$reservation_date} <br/> {$reservation_start_time} - {$reservation_end_time}</span>",
                    'category' => $reservation->category,
                ];
            });

        return ($reservations->setCollection($reservationCollection));
    }
}

