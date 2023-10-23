<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'vendor_name' => ['required', 'max:255'],
            // 'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['email', 'nullable','max:255'],
            'product_community' => [ 'required', 'max:255'],
            'product_range' => [ 'required','max:255'],
            'location' => [ 'required','max:100'],
            'country' => [ 'required','max:100'],
            'city' => [ 'required','max:100'],
            'phone' => ['required','digits_between:5,15','numeric','nullable'],
            'facsimile' =>  ['digits_between:5,15','numeric','nullable'],
            'website' => ['url','nullable', 'max:100'],
            'postal_code' => ['required','digits_between:5,15','numeric','nullable'],
        ];
    }
}
