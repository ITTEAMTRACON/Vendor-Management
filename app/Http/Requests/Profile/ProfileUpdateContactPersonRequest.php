<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProfileUpdateContactPersonRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */

     protected function failedValidation(Validator $validator)
     {
         // Handle the failed validation, e.g., redirect to a custom route
         throw new HttpResponseException(
             back()
             ->with('contact-person',true)
             ->withErrors($validator)
            ->withInput($this->input())
           
         );
     }
    public function rules(): array
    {
        return [
            'cp_name' => ['required', 'max:255'],
            // 'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'cp_position' => ['required', 'nullable','max:50'],
            'cp_email' => ['required','email', 'nullable','max:50'],
            'cp_phone' => ['digits_between:5,15','numeric','nullable'],
            'cp_mobile_phone' => ['required','digits_between:5,15','numeric','nullable'],
            'cp_facsimile' =>  ['digits_between:5,15','numeric','nullable'],
        ];
    }
}
