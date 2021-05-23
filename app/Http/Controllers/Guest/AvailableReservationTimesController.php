<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\OpeningHour;
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
    public function __invoke(Request $request): JsonResponse
    {
        $day = strtolower(Carbon::parse($request->date)->dayName);
        $roomType = $request->room_type;

        $query = OpeningHour::query()
            ->select(['start_time', 'end_time'])
            ->where('day', $day);

        if($roomType){
            $query = $query
                ->where('room_type_id', $roomType);
        }

        $openingHours = $query
            ->first();

        $data = collect();

        if (!$openingHours->start_time) {
            return response()->json($data);
        }

        $startTime = Carbon::parse($openingHours->start_time);
        $endTime = Carbon::parse($openingHours->end_time);

        $hoursArray = $startTime->range($endTime, 1, 'hours')
            ->excludeEndDate();

        foreach ($hoursArray as $hour) {
            $data->push([
                'start_time' => $hour->format('H:i'),
                'end_time' => $hour->addHour()->format("H:i"),
                'is_booked' => (boolean) 0,
            ]);
        }
        return response()->json($data);
    }
}
