<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorReviewRequest extends FormRequest
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
            'selected_ratings'  => 'required|regex:/[1-5]/',
            'review'            => 'required',
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
            'selected_ratings.required' => 'Please rate this vendor',
            'selected_ratings.regex'    => 'Please rate this vendor',
            'review.required'           => 'Please type :attribute.'
        ];
    }
}
