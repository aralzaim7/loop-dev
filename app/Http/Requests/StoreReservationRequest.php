<?php

namespace App\Http\Requests;

use App\Rules\DateFormatArray;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'numeric', 'exists:reservation_categories,id'],
            'room_type_id' => ['required', 'numeric', 'exists:room_types,id'],
            'reservation_date' => ['required', 'date_format:Y-m-d'],
            'selected_time_slots' => ['required', 'array'],
            'selected_time_slots.*' => ['required', new DateFormatArray()],
        ];
    }
}
