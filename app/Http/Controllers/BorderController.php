<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\BorderValidation;
use Illuminate\Http\Request;

/**
 * Class BorderController
 *
 * @package App\Http\Controllers
 */
class BorderController extends Controller
{
    private $country;

    /**
     * BorderController constructor.
     *
     * @param Country $country
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * Attach a border to a country.
     *
     * @see:unit-test   \Tests\Feature\BorderControllerTest::testCreateBorderNoCountry()
     * @see:unit-test   TODO: when border attached.
     * @see:unit-test   \Tests\Feature\BorderControllerTest::testCreateBorderValidationErrors()
     *
     * @param  BorderValidation $input      The user input.
     * @param  int              $countryId  The country id in the database
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(BorderValidation $input, $countryId)
    {
        $country = $this->country->find($countryId);

        if ($country) { // Country exists
            if ($country->borders()->attach($input->borderId)) { // The border has been created
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('country.flash-border-create'));
            }
        }

        return back();
    }

    /**
     * Delete a border from a country.
     *
     * @see:unit-test   TODO: when no border or country exists.
     * @see:unit-test   TODO: when border removed.
     *
     * @param  int $countryId  The country id in the database.
     * @param  int $borderId   The border id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($countryId, $borderId)
    {
        $db['country'] = $this->country->find($countryId);
        $db['border']  = $this->country->find($borderId);

        if ($db['country'] && $db['border']) { // Record if found
            if ($db['country']->borders()->detach($db['border']->id)) { // Record is deleted
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('country.flash-border-delete'));
            }
        }

        return back();
    }
}
