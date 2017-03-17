<?php

namespace App\Http\Controllers;

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
     * CountryController constructor
     * .
     * @param Country $dbCountry
     */
    public function __construct(Country $dbCountry)
    {
        $this->middleware('auth');

        $this->dbCountry = $dbCountry;
    }

    /**
     * Get the country listing.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $model = $this->dbCountry;

        $data['title']     = trans('');
        $data['countries'] = $model->with($this->countryRelations)->paginate(15);

        return view('countries.index', $data);
    }

    public function edit()
    {

    }

    /**
     * Update a country in the database.
     *
     * @param  CountryValidation $input      The user input validation.
     * @param  int               $countryId  The id for the country.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CountryValidation $input, $countryId)
    {
        return back();
    }

    /**
     * Delete a country out off the database.
     *
     * @param  int $countryId The id for the country.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($countryId)
    {
        if ($this->dbCountry->delete($countryId)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('country.flash-delete'));
        }

        return back();
    }
}
