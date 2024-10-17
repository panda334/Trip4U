<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => ['required' , 'max:20' , 'min:3'],
            'last_name' => ['required' , 'max:20' , 'min:3'],
            'email' => ['email' , 'required'],
            'phone_number' => ['required' , 'numeric' , 'starts_with:09'  , 'min:10'],
            'address' => ['nullable' , 'max:100' , 'min:5'],
        ];
    }
}
