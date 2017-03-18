<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Transformers\CountryTransformer;
use App\Traits\ApiRendering;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
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
        'create' => ['level' => 20], // Volunteer
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

        // Validation rules
        $this->rules['name']         = 'required';
        $this->rules['code']         = 'required';
        $this->rules['continent_id'] = 'required';
        $this->rules['iso_alpha_2']  = 'required';
        $this->rules['iso_alpha_3']  = 'required';
        $this->rules['fips_code']    = 'required';
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

    /**
     * Update a country resource in the API.
     *
     * @param  Request  $request  The user input interface.
     * @param  Log      $log      The logging interface.
     * @return mixed
     */
    public function create(Request $request, Log $log)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) { // Validation fails.
            $content['http_code'] = Response::HTTP_BAD_REQUEST;
            $content['message']   = 'There are validation errors';
            $content['errors']    = $validator->errors()->all();

            return response($content, Response::HTTP_BAD_REQUEST)
                ->header('Content-Type', 'application/json');
        }

        // No validation errors found so.
        // So we can move on with our logic.
        // We use custom fields. Because the ux in the API.

        try { // Try to insert the new data through Elo. mass-assign.
            $this->dbCountry->create($request->all());

            // Set the output content.
            $content['http_code'] = Response::HTTP_ACCEPTED;
            $content['message']   = 'The country has been updated';

            return response($content, Response::HTTP_ACCEPTED)
                ->header('Content-Type', 'application/json');

        } catch (MassAssignmentException $exception) {
            $content['http_code'] = Response::HTTP_INTERNAL_SERVER_ERROR;
            $content['message']   = 'Oops there is something wrong.';

            $log->critical($exception); // Write the exception to the log.

            return response($content, Response::HTTP_INTERNAL_SERVER_ERROR)
                ->header('Content-Type', 'application/json');
        }
    }

    public function delete($countryId)
    {

    }
}
