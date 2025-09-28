<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name'   => 'required|string|max:255',
            'service_type'   => 'required|in:authorized,private,independent',
            'description'    => 'nullable|string',
            'address'        => 'required|text',
            'phone'          => 'required|string|max:20',
            'email'          => 'required|email',
            'password'       => 'required|min:8|confirmed',
        ];
    }
}
