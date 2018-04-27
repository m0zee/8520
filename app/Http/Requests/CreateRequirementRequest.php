<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequirementRequest extends FormRequest
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
            'name'              => 'required',
            'unit_id'           => 'required',
            'quantity'          => 'regex:/^[1-9]+[0-9]*$/',
            'description'       => 'required',
            'category_id'       => 'required',
            'sub_category_id'   => 'required',
            'country_id'        => 'required',
            'state_id'          => 'required',
            'city_id'           => 'required',
            'img'               => 'mimes:jpg,jpeg,png|max:2000',
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
            'name.required'             => 'Please enter requirement',
            'unit_id.required'          => 'Please select unit',
            'quantity.regex'            => 'Please enter quantity greate than 0',
            'description.required'      => 'Plese enter description',
            'category_id.required'      => 'Please select category',
            'sub_category_id.required'  => 'Please select sub category',
            'country_id.required'       => 'Please select country',
            'state_id.required'         => 'Please select state',
            'city_id.required'          => 'Please select city',
            'img'                       => 'mimes:jpg,jpeg,png|max:2000',
        ];
    }
}
