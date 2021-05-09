<?php

namespace App\Http\Requests;

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
            'room_type' => ['required', 'string'],
            'reservation_date' => ['required', 'date_format:Y-m-d'],
            'reservation_start_time' => ['required', 'date_format:H:i'],
            'reservation_end_time' => ['required', 'date_format:H:i'],
        ];
    }
}
