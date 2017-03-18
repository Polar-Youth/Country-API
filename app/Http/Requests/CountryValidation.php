<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CountryValidation
 *
 * @package App\Http\Requests
 */
class CountryValidation extends FormRequest
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
            'continent'     => 'required',
            'code'          => 'required',
            'iso_alpha_2'   => 'required',
            'iso_alpha_3'   => 'required',
            'fips_code'     => 'required',
        ];
    }
}
