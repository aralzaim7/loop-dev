<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\OpeningHour;
use App\Models\Reservation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class AvailableReservationTimesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $reservationDay = strtolower(Carbon::parse($request->date)->dayName);
        $reservationDate = Carbon::parse($request->date)->format('Y-m-d');
        $roomType = $request->room_type;

        $data = collect();

        if ($roomType) {
            $openingHours = OpeningHour::query()
                ->select(['start_time', 'end_time'])
                ->where('day', $reservationDay)
                ->where('room_type_id', $roomType)
                ->first();
        } else {
            return response()->json($data);
        }
        if (!$openingHours->start_time && !$openingHours->end_time) {
            return response()->json($data);
        }

        $startTime = Carbon::parse($openingHours->start_time);
        $endTime = Carbon::parse($openingHours->end_time);

        $hoursArray = $startTime->range($endTime, 1, 'hours')
            ->excludeEndDate();

        foreach ($hoursArray as $hour) {

            $bookedSlot = Reservation::query()
                ->where('room_type_id', $roomType)
                ->where('reservation_start_time', '<=', $hour->format('H:i:s'))
                ->where('reservation_end_time', '>', $hour->format('H:i:s'))
                ->where('reservation_date', $reservationDate)
                ->first();

            $data->push([
                'start_time' => $hour->format('H:i'),
                'end_time' => $hour->addHour()->format("H:i"),
                'is_booked' => (boolean) ($bookedSlot ? 1 : 0),
            ]);
        }
        return response()->json($data);
    }
}
