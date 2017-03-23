<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

/**
 * Class BorderController
 *
 * @package App\Http\Controllers
 */
class BorderController extends Controller
{
    /**
     * @var Country
     */
    private $countries;

    /**
     * CountryActions constructor.
     *
     * @param Country $countries
     */
    public function __construct(Country $countries)
    {
        $this->middleware('role:admin,border_permissions');
        $this->middleware('find-resource:country')->only(['insertBorder']);

        $this->countries = $countries;
    }

    /**
     * Insert a new border.
     *
     * TODO: write unit test when no resource
     * TODO: write unit test validation error
     * TODO: write unit test when validation passes.
     *
     * @param  Request $input     The user input.
     * @param  int     $countryId The country id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertBorder(Request $input, $countryId)
    {
        $this->validate($input, ['country' => 'required']);

        if ($this->countries->find($countryId)->borders()->attach($input->country)) { // Border has been added.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('countries.flash-add-border'));

            // Notify the admins.
            // TODO: Implement notification system.
        }

        return back();
    }

    /**
     * Remove a border from a country.
     *
     * TODO: write unit test when fails
     * TODO: write unit test when success.
     *
     * @param  int $borderId   The id for the border country.
     * @param  int $countryId  The id for the country that gets the country.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeBorder($countryId, $borderId)
    {
        // TODO: catch the detach with an exception.

        if ($this->countries->find($countryId)->borders->detach($borderId)) { // Deleted the border.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('countries.flash-remove-border'));

            // Notify the admins.
            // TODO: Implement notification system.
        }

        return back();
    }
}
