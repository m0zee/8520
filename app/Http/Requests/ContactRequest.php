<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'          => 'required',
            'email'         => 'required|email',
            'contact_number'=> 'required',
            'country_id'    => 'required',
            'state_id'      => 'required',
            'city_id'       => 'required',
            'message'       => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => 'Please enter your name',
            'email.required'            => 'Please enter your email address',
            'email.email'               => 'Please enter valid email address',
            'country_id.required'       => 'Please select country',
            'state_id.required'         => 'Please select state',
            'city_id.required'          => 'Please select city',
            'message.required'          => 'Please enter message',
        ];
    }
}
