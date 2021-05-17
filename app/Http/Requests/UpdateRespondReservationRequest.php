<?php

namespace App\Http\Requests;

use App\Types\ReservationStatuses;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRespondReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $statuses = ReservationStatuses::getAllStatuses();
        return ['status' => ['required', 'string', Rule::in($statuses)],

        ];
    }
}
