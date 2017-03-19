<?php

namespace App\Http\Transformers;

use App\Country;
use League\Fractal;

/**
 * Class CountryTransformer
 *
 * @package App\Http\Transformers
 */
class CountryTransformer extends Fractal\TransformerAbstract
{
    /**
     * Country transformer for the API Interface.
     *
     * @param   Country $country
     * @return  array
     */
   public function transform(Country $country)
   {
       return [
            'name'     => $country->name,
            'flag'     => asset('images/' . $country->iso_alpha_2 . '.svg'),
            'iso_3166' => [
                'alpha_2' => $country->iso_alpha_2,
                'alpha_3' => $country->iso_alpha_3
            ]
       ];
   }
}