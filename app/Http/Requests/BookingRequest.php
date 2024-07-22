<?php

namespace App\Http\Requests;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'adult' => 'required'|'numeric',
            'children' => 'numeric'|'nullable',
            'infant' => 'numeric'|'nullable',
            'start_date' => 'date'|'required',
            'end_date' => 'date'|'required'
        ];
    }
}
