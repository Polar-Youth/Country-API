<?php

namespace App\Http\Controllers;

use App\Continents;
use App\Country;
use App\Http\Requests\CountryValidation;
use Illuminate\Http\Request;

/**
 * Class CountryController
 *
 * @package App\Http\Controllers
 */
class CountryController extends Controller
{
    /**
     * @var Country
     */
    private $dbCountry;

    /**
     * @var Continents
     */
    private $dbContinent;

    /**
     * CountryController constructor
     *
     * @param Continents  $dbContinent
     * @param Country     $dbCountry
     */
    public function __construct(Country $dbCountry, Continents $dbContinent)
    {
        // $this->middleware('auth');

        $this->dbCountry   = $dbCountry;
        $this->dbContinent = $dbContinent;
    }

    /**
     * Get the country listing.
     *
     * @see:unit-test   \Tests\Feature|CountryControllerTest::testIndexController()
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $model = $this->dbCountry;

        $data['title']      = trans('country.title-index');
        $data['countries']  = $model->with(['continent'])->paginate(15);
        $data['continents'] = $this->dbContinent->all();

        return view('countries.index', $data);
    }

    /**
     * Create a new country in the database.
     *
     * @see:unit-test   TODO: Write unit test (validation fails).
     * @see:unit-test   TODO: Write unit test (validation success).
     *
     * @param  CountryValidation $input The user input validation;
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryValidation $input)
    {
        if ($this->dbCountry->create($input->except(['_token']))) {
            session()->flash('class', 'alert alert-danger');
            session()->flash('meesage', trans('country.flash-create'));
        }

        return back();
    }

    /**
     * Display specific information about a country.
     *
     * @see:unit-test   \Tests\Feature\CountryControllerTest::testShowController()
     *
     * @param  int $countryId the country id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($countryId)
    {
        $data['country'] = $this->dbCountry->with(['continent', ])->find($countryId);
        $data['title']   = $data['country']->name;

        return view('countries.show', $data);
    }

    /**
     * Update a country in the database.
     *
     * @see:unit-test   TODO: Write unit test (validation fails).
     * @see:unit-test   TODO: Write unit test (validation passes).
     * @see:unit-test   TODO: Write unit test (No resource).
     *
     * @param  CountryValidation $input      The user input validation.
     * @param  int               $countryId  The id for the country.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CountryValidation $input, $countryId)
    {
        // TODO: Implement check to see if the resource exists.

        $data = $this->dbCountry->find($countryId);

        if ($data->update($input->except['_token'])) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('country.flash-udate'));
        }

        return back();
    }

    /**
     * Delete a country out off the database.
     *
     * @see:unit-test   \Tests\Feature\CountryControllerTest::testDeleteControllerValid()
     * @see:unit-test   \Tests\Feature\CountryControllerTest::testDeleteControllerInvalid()
     *
     * @param  int $countryId The id for the country.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($countryId)
    {
        // TODO: Implement admin permissions for using this route.
        $record = $this->dbCountry->find($countryId);

        if ((int) count($record) == 1) {
            if ($record->delete()) {
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('country.flash-delete', ['country' => $record->name]));
            }
        }

        return back();
    }
}
