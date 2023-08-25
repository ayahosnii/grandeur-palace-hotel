<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'customer.firstname' => 'required|string',
            'customer.lastname' => 'required|string',
            'customer.phone' => 'required|integer',
            'customer.email' => 'required|email|unique:customers,email',
        ];
    }
}