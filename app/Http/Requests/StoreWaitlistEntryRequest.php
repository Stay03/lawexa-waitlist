<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWaitlistEntryRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:waitlist_entries,email',
            ],
            'name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'waitlist-ref' => [
                'nullable',
                'string',
                'exists:waitlist_entries,referral_code',
            ],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'An email address is required to join the waitlist.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already on the waitlist.',
            'waitlist-ref.exists' => 'The referral code provided is invalid.',
        ];
    }
}
