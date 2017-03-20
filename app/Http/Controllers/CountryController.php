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
     * @see:unit-test   /Tests/Feature/CountryControllerTest::testResourceInsertError()
     * @see:unit-test   /Tests\Feature/CountryControllerTest::testResourceInsert()
     *
     * @param  CountryValidation $input The user input validation;
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryValidation $input)
    {
        if ($this->dbCountry->create($input->except(['_token']))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('country.flash-create'));
        }

        return back();
    }

    /**
     * Display specific information about a country.
     *
     * @see:unit-test   \Tests\Feature\CountryControllerTest::testShowControllerValid()
     * @see:unit-test   \Tests\Feature\CountryControllerTest::testDeleteControllerInvalid()
     *
     * @param  int $countryId the country id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($countryId)
    {
        $data['country'] = $this->dbCountry->with(['continent', ])->find($countryId);

        if ($data['country']) {
            $data['title']   = $data['country']->name;

            return view('countries.show', $data);
        }

        return redirect()->route('country');
    }

    /**
     * Update a country in the database.
     *
     * @see:unit-test   \Tests\Feature\CountryControllerTest::testResourceExistValidationError()
     * @see:unit-test   \Tests\Feature\CountryControllerTest::
     * @see:unit-test   \Tests\Feature\CountryControllerTest::testResourceNotExistUpdate()
     *
     * @param  CountryValidation $input      The user input validation.
     * @param  int               $countryId  The id for the country.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CountryValidation $input, $countryId)
    {
        $record = $this->dbCountry->find($countryId);

        if ($record) { // Record has been found.
            if ($record->update($input->except('_token'))) {
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('country.flash-update', ['country' => $record->name]));
            }

            return back();
        }

        return redirect()->route('country');
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
        $record = $this->dbCountry->find($countryId);

        if ($record) { // Check if the record is found.
            if ($record->delete()) { // Record has been deleted.
                session()->flash('class', 'alert alert-success');
                session()->flash('message', trans('country.flash-delete', ['country' => $record->name]));
            }

            return back();
        }

        return redirect()->route('country');
    }
}
