<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'number_of_participants' => 'required|numeric',
            'booking_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'discount_percentage' => 'nullable|numeric'
        ];
    }

    public function messages()
    {
        return [
            'number_of_participants.required' => __('validation.requiredField' , ['field' => 'number of participants']),
            'number_of_participants.numeric' => __('validation.numericField' , ['field' => 'number of participants']),

            'booking_date.required' => __('validation.requiredField' , ['field' => 'booking']),
            'booking_date.date' => __('validation.dateField' , ['field' => 'booking']),

            'user_id.required' => __('validation.requiredField' , ['field' => 'user']),
            'user_id.exists' => __('validation.doesnotExists' , ['field' => 'user']),

            'room_id.required' => __('validation.requiredField' , ['field' => 'room']),
            'room_id.exists' => __('validation.doesnotExists' , ['field' => 'room']),

            'time_slot_id.required' => __('validation.requiredField' , ['field' => 'time slot']),
            'time_slot_id.exists' => __('validation.doesnotExists' , ['field' => 'time slot']),

            'discount_percentage.numeric' => __('validation.numericField' , ['field' => 'discount percentage']),

        ];
    }
}
