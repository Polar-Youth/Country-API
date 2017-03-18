<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Transformers\CountryTransformer;
use App\Traits\ApiRendering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use League\Fractal\Pagination\Cursor;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiCountryController
 *
 * @package App\Http\Controllers
 */
class ApiCountryController extends Controller
{
    use ApiRendering;

    /**
     * API ACL Permissions
     *
     * @return array
     */
    protected $apiMethods = [
        'update' => ['level' => 20], // Volunteer
        'delete' => ['level' => 30], // Administrator.
    ];

    /**
     * @var Country
     */
    private $dbCountry;

    /**
     * @var $rules
     */
    public $rules = [];

    /**
     * ApiCountryController constructor.
     *
     * @param Country $dbCountry
     */
    public function __construct(Country $dbCountry)
    {
        $this->dbCountry = $dbCountry;

            //'iso_alpha_2'   => 'required',
            //'iso_alpha_3'   => 'required',
            //'fips_code'     => 'required',

        // Validation rules
        $this->rules['name']         = 'required';
        $this->rules['code']         = 'required';
        $this->rules['continent_id'] = 'required';
    }

    /**
     * Get all the countries that are in the data storage.
     *
     * @param  Input  $input  The input facade from laravel.
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Input $input)
    {
        $current  = $input->get('cursor', null);
        $previous = $input->get('previous', null);
        $limit    = $input->get('limit', 10);

        if ($current) {
            $countries = $this->dbCountry->where('id', '>', $current)->take($limit)->get();
        } else {
            $countries = $this->dbCountry->take($limit)->get();
        }

        if ($countries->count() > 0) {
            $newCursor = $countries->last()->id;
            $cursor    = new Cursor($current, $previous, $newCursor, $countries->count());

            $res['accept']  = $this->checkAcceptEncoding();
            $res['content'] = fractal()->collection($countries, new CountryTransformer)->withCursor($cursor);
            $res['status']  = Response::HTTP_OK;

            if ((string) $res['accept'] === 'application/xml' || (string) $res['accept'] === 'text/xml') {
                // TODO: Add library for xml rendering.
                // TODO: Implement this in V2.0.0

                // response($res['content'], $res['status'])
                //    ->header('Content-Type', $res['accept']);
            } elseif ((string) $res['accept'] === 'application/json' || (string) $res['accept'] === 'text/json') {
                return response($res['content'], $res['status'])
                    ->header('Content-Type', $res['accept']);
            }
        }

        // No data found.
        return response(['message' => 'Resource not found.'], Response::HTTP_OK)
            ->header('Content-Type', $this->checkAcceptEncoding());

    }

    public function update()
    {

    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) { // Validation fails.

        }
    }

    public function delete($countryId)
    {

    }
}
