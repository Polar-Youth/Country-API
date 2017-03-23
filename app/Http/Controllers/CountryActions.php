<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryActions extends Controller
{
    private $countries;

    public function construct(Country $countries)
    {
        $this->middleware('auth');

        $this->countries = $countries;
    }
}
